<?php

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use ArangoDb\Handler\Statement;
use ArangoDb\Http\Client;
use ArangoDb\Http\ClientOptions;
use ArangoDb\Http\TransactionalClient;
use ArangoDb\Http\TypeSupport;
use ArangoDb\Statement\ArrayStreamHandlerFactory;
use ArangoDb\Statement\StreamHandlerFactoryInterface;
use ArangoDb\Type\Batch;
use ArangoDb\Type\Database;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\StreamFactory;
use PDO;
use Prooph\Common\Messaging\FQCNMessageFactory;
use Prooph\EventStore\ArangoDb\ArangoDbTransactionalEventStore as ArangoDbEventStore;
use Prooph\EventStore\ArangoDb\Projection\ProjectionManager as ArangoDbProjectionManager;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Pdo\MariaDbEventStore;
use Prooph\EventStore\Pdo\MySqlEventStore;
use Prooph\EventStore\Pdo\PostgresEventStore;
use Prooph\EventStore\Pdo\Projection\MariaDbProjectionManager;
use Prooph\EventStore\Pdo\Projection\MySqlProjectionManager;
use Prooph\EventStore\Pdo\Projection\PostgresProjectionManager;
use Prooph\EventStore\Projection\ProjectionManager;
use Prooph\EventStore\StreamName;
use Prooph\EventStore\Util\Assertion;
use ProophTest\EventStore\Mock\TestDomainEvent;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use function Prooph\EventStore\ArangoDb\Func\eventStreamsBatch;
use function Prooph\EventStore\ArangoDb\Func\projectionsBatch;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
$whoops->register();

function testDatabases(): array
{
    return [
        'mysql' => \getenv('MYSQL_DB'),
        'mariadb' => \getenv('MARIADB_DB'),
        'postgres' => \getenv('POSTGRES_DB'),
        'arangodb' => \getenv('ARANGODB_DB'),
    ];
}

function checkWriteIntegrity(EventStore $eventStore, int $numberStreams, int $numberEvents)
{
    $streamNames = $eventStore->fetchStreamNames(null, null, 100000);
    Assertion::eq(
        \count($streamNames),
        $numberStreams,
        'Number of streams invalid: Value "%s" does not equal expected value "%s".'
    );
    $count = 0;
    foreach ($streamNames as $streamName) {
        $events = $eventStore->load($streamName);
        $count += \iterator_count($events);
    }
    Assertion::eq($count, $numberEvents, 'Number of events invalid: Value "%s" does not equal expected value "%s".');
}

function createStreamStrategy(string $driver)
{
    switch (\strtolower($driver)) {
        case 'mysql':
            $class = 'Prooph\EventStore\Pdo\PersistenceStrategy\MySql' . \getenv('STREAM_STRATEGY') . 'StreamStrategy';

            return new $class();
        case 'mariadb':
            $class = 'Prooph\EventStore\Pdo\PersistenceStrategy\MariaDb' . \getenv('STREAM_STRATEGY') . 'StreamStrategy';

            return new $class();
        case 'postgres':
            $class = 'Prooph\EventStore\Pdo\PersistenceStrategy\Postgres' . \getenv('STREAM_STRATEGY') . 'StreamStrategy';

            return new $class();
        case 'arangodb':
            $class = 'Prooph\EventStore\ArangoDb\PersistenceStrategy\\' . \getenv('STREAM_STRATEGY') . 'StreamStrategy';

            return new $class();
        default:
            throw new \RuntimeException(\sprintf('Driver "%s" not supported', $driver));
    }
}

function createConnection(string $driver)
{
    switch (\strtolower($driver)) {
        case 'mysql':
            $host = \getenv('MYSQL_HOST');
            $port = \getenv('MYSQL_PORT');
            $dbName = \getenv('MYSQL_DB');
            $charset = \getenv('MYSQL_CHARSET');
            $username = \getenv('MYSQL_USER');
            $password = \getenv('MYSQL_PASSWORD');

            return new PDO("mysql:host=$host;port=$port;dbname=$dbName;charset=$charset;", $username, $password);
        case 'mariadb':
            $host = \getenv('MARIADB_HOST');
            $port = \getenv('MARIADB_PORT');
            $dbName = \getenv('MARIADB_DB');
            $charset = \getenv('MARIADB_CHARSET');
            $username = \getenv('MARIADB_USER');
            $password = \getenv('MARIADB_PASSWORD');

            return new PDO("mysql:host=$host;port=$port;dbname=$dbName;charset=$charset", $username, $password);
        case 'postgres':
            $host = \getenv('POSTGRES_HOST');
            $port = \getenv('POSTGRES_PORT');
            $dbName = \getenv('POSTGRES_DB');
            $charset = \getenv('POSTGRES_CHARSET');
            $username = \getenv('POSTGRES_USER');
            $password = \getenv('POSTGRES_PASSWORD');

            return new PDO("pgsql:host=$host;port=$port;dbname=$dbName;options='--client_encoding=\"$charset\"'", $username, $password);
        case 'arangodb':
            $connection = new TransactionalClient(
                getArangoDbHttpClient(),
                getResponseFactory()
            );

            return $connection;
    }
}

function createDatabase($connection, string $driver, string $dbName): void
{
    switch (\strtolower($driver)) {
        case 'mysql':
        case 'mariadb':
        case 'postgres':
            try {
                $path = '../vendor/prooph/pdo-event-store/scripts/' . $driver . '/';
                $connection->exec(\file_get_contents($path . '01_event_streams_table.sql'));
                $connection->exec(\file_get_contents($path . '02_projections_table.sql'));
            } catch (\Throwable $e) {
                echo $e->getMessage();
            }

            break;
        case 'arangodb':
            // need own client to create database
            $client = getArangoDbHttpClient(true);
            $response = $client->sendType(Database::create($dbName));

            if ($response->getStatusCode() !== 201) {
                throw new \RuntimeException('Database could not be created');
            }
            $connection->sendType(
                Batch::fromTypes(...eventStreamsBatch())
            );
            $connection->sendType(
                Batch::fromTypes(...projectionsBatch())
            );
            sleep(10);
            break;
        default:
            throw new \RuntimeException(\sprintf('Driver "%s" not supported', $driver));
    }
    unset($connection);
    // give DB some time
    \sleep(1);
}

function destroyDatabase($connection, string $driver, string $dbName): void
{
    switch (\strtolower($driver)) {
        case 'mysql':
        case 'mariadb':
        case 'postgres':
            /* @var PDO $connection */
            $statement = $connection->query('SELECT stream_name FROM event_streams;');
            $rows = $statement->fetchAll();
            foreach ($rows as $row) {
                $connection->exec('DROP TABLE ' . $row['stream_name'] . ';');
            }
            $connection->exec('DROP TABLE event_streams;');
            $connection->exec('DROP TABLE projections;');
            break;
        case 'arangodb':
            $type = 'application/' . (\getenv('USE_VPACK') === 'true' ? 'x-velocypack' : 'json');
            // need own client to create database
            $client = getArangoDbHttpClient(true);
            $response = $client->sendType(Database::delete($dbName));

            if ($response->getStatusCode() !== 200) {
                throw new \RuntimeException('Database could not be created');
            }
            break;
        default:
            throw new \RuntimeException(\sprintf('Driver "%s" not supported', $driver));
    }
}

function createEventStore(string $driver, $connection): EventStore
{
    switch (\strtolower($driver)) {
        case 'mysql':
            return new MySqlEventStore(
                new FQCNMessageFactory(),
                $connection,
                createStreamStrategy($driver)
            );
        case 'mariadb':
            return new MariaDbEventStore(
                new FQCNMessageFactory(),
                $connection,
                createStreamStrategy($driver)
            );
        case 'postgres':
            return new PostgresEventStore(
                new FQCNMessageFactory(),
                $connection,
                createStreamStrategy($driver)
            );
        case 'arangodb':
            return new ArangoDbEventStore(
                new FQCNMessageFactory(),
                $connection,
                new Statement(getArangoDbHttpClient(), getStreamHandlerFactory()),
                createStreamStrategy($driver)
            );
    }
}

function createProjectionManager(EventStore $eventStore, string $driver, $connection): ProjectionManager
{
    switch (\strtolower($driver)) {
        case 'mysql':
            return new MySqlProjectionManager(
                $eventStore,
                $connection
            );
        case 'mariadb':
            return new MariaDbProjectionManager(
                $eventStore,
                $connection
            );
        case 'postgres':
            return new PostgresProjectionManager(
                $eventStore,
                $connection
            );
        case 'arangodb':
            return new ArangoDbProjectionManager(
                $eventStore,
                $connection,
                new Statement($connection, getStreamHandlerFactory())
            );
    }
}

function createConnections(array $drivers): array
{
    $data = [];

    foreach ($drivers as $driver) {
        $data[$driver] = createConnection($driver);
    }

    return $data;
}

function createEventStores(array $connections): array
{
    $data = [];

    foreach ($connections as $driver => $connection) {
        $data[$driver] = createEventStore($driver, $connections[$driver]);
    }

    return $data;
}

function createProjectionManagers(array $eventStores, array $connections): array
{
    $data = [];

    foreach ($connections as $driver => $connection) {
        $data[$driver] = createProjectionManager($eventStores[$driver], $driver, $connections[$driver]);
    }

    return $data;
}

function createTestEvent(array $payload, int $version)
{
    $event = TestDomainEvent::with($payload, $version);
    $event = $event->withAddedMetadata('_aggregate_id', $event->uuid()->toString());

    return $event->withAddedMetadata('_aggregate_type', 'TestDomainEvent');
}

function createTestStreamName()
{
    return new StreamName(\uniqid('stream'));
}

function createTestEvents(array $payload, int $amount, int $startFrom = 0)
{
    $events = [];

    for ($j = 0; $j < $amount; ++$j) {
        $events[] = createTestEvent($payload, ++$startFrom);
    }

    return $events;
}

function testPayload(): array
{
    return [
        'key1' => 'value1',
        'key2' => 2,
        'key3' => 'some@mail.com',
        'key4' => 'value4',
        'key5' => true,
        'key6' => false,
        'key7' => 7,
    ];
}

function outputText(string $text, bool $useDate = true, string $lineEnding = PHP_EOL)
{
    $time = new \DateTime('now');
    if ($useDate) {
        echo $time->format('Y-m-d\TH:i:s.u') . ': ' . $text . $lineEnding;
    } else {
        echo $text . $lineEnding;
    }
}

function getArangoDbHttpClient($useSystemDatabase = false): TypeSupport
{
    $options = [
        ClientOptions::OPTION_ENDPOINT => getenv('ARANGODB_HOST'),
        ClientOptions::OPTION_RECONNECT => true,
    ];

    if ($useSystemDatabase === false) {
        $options[ClientOptions::OPTION_DATABASE] = getenv('ARANGODB_DB');
    }

    return new Client(
        $options,
        getRequestFactory(),
        getResponseFactory(),
        getStreamFactory()
    );
}

function getResponseFactory(): ResponseFactoryInterface
{
    return new class implements ResponseFactoryInterface
    {
        public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
        {
            $response = new Response();

            if ($reasonPhrase !== '') {
                return $response->withStatus($code, $reasonPhrase);
            }

            return $response->withStatus($code);
        }
    };
}

function getRequestFactory(): RequestFactoryInterface
{
    return new class implements RequestFactoryInterface
    {
        public function createRequest(string $method, $uri): RequestInterface
        {
            $type = 'application/json';

            $request = new Request($uri, $method);
            $request = $request->withAddedHeader('Content-Type', $type);
            return $request->withAddedHeader('Accept', $type);
        }
    };
}

function getStreamFactory(): StreamFactoryInterface
{
    return new StreamFactory();
}

function getStreamHandlerFactory(): StreamHandlerFactoryInterface
{
    return new ArrayStreamHandlerFactory();
}

function getMemoryConsumption(): string
{
    $memUsage = memory_get_usage();
    $memPeak = memory_get_peak_usage();

    return '(' . round($memUsage / 1024 / 1024, 2) . 'MB / ' . round($memPeak / 1024 / 1024, 2) . ' MB)';
}
