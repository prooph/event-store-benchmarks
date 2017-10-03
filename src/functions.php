<?php

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use ArangoDBClient\Connection;
use ArangoDBClient\ConnectionOptions;
use ArangoDBClient\UpdatePolicy;
use ArangoDBClient\Urls;
use PDO;
use Prooph\Common\Messaging\FQCNMessageFactory;
use function Prooph\EventStore\ArangoDb\Fn\eventStreamsBatch;
use function Prooph\EventStore\ArangoDb\Fn\execute;
use function Prooph\EventStore\ArangoDb\Fn\projectionsBatch;
use Prooph\EventStore\ArangoDb\Type\DeleteCollection;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Pdo\MariaDbEventStore;
use Prooph\EventStore\Pdo\MySqlEventStore;
use Prooph\EventStore\Pdo\PersistenceStrategy\MariaDbAggregateStreamStrategy;
use Prooph\EventStore\Pdo\PersistenceStrategy\MySqlAggregateStreamStrategy;
use Prooph\EventStore\Pdo\PersistenceStrategy\PostgresAggregateStreamStrategy;
use Prooph\EventStore\Pdo\PostgresEventStore;
use Prooph\EventStore\Pdo\Projection\MariaDbProjectionManager;
use Prooph\EventStore\Pdo\Projection\MySqlProjectionManager;
use Prooph\EventStore\Pdo\Projection\PostgresProjectionManager;
use Prooph\EventStore\Projection\ProjectionManager;
use Prooph\EventStore\StreamName;
use ProophTest\EventStore\Mock\TestDomainEvent;
use Prooph\EventStore\ArangoDb\Projection\ProjectionManager as ArangoDbProjectionManager;
use Prooph\EventStore\ArangoDb\EventStore as ArangoDbEventStore;
use Prooph\EventStore\ArangoDb\PersistenceStrategy\AggregateStreamStrategy as ArangoDbAggregateStreamStrategy;

function testDatabases(): array
{
    return [
        'mysql' => getenv('MYSQL_DB'),
        'mariadb' => getenv('MARIADB_DB'),
        'postgres' => getenv('POSTGRES_DB'),
        'arangodb' => getenv('ARANGODB_DB'),
    ];
}

function createConnection(string $driver)
{
    switch (strtolower($driver)) {
        case 'mysql':
            $host = getenv('MYSQL_HOST');
            $port = getenv('MYSQL_PORT');
            $dbName = getenv('MYSQL_DB');
            $charset = getenv('MYSQL_CHARSET');
            $username = getenv('MYSQL_USER');
            $password = getenv('MYSQL_PASSWORD');

            return new PDO("mysql:host=$host;port=$port;charset=$charset;", $username, $password);
        case 'mariadb':
            $host = getenv('MARIADB_HOST');
            $port = getenv('MARIADB_PORT');
            $dbName = getenv('MARIADB_DB');
            $charset = getenv('MARIADB_CHARSET');
            $username = getenv('MARIADB_USER');
            $password = getenv('MARIADB_PASSWORD');

            return new PDO("mysql:host=$host;port=$port;charset=$charset", $username, $password);
        case 'postgres':
            $host = getenv('POSTGRES_HOST');
            $port = getenv('POSTGRES_PORT');
            $dbName = getenv('POSTGRES_DB');
            $charset = getenv('POSTGRES_CHARSET');
            $username = getenv('POSTGRES_USER');
            $password = getenv('POSTGRES_PASSWORD');

            return new PDO("pgsql:host=$host;port=$port;options='--client_encoding=\"$charset\"'", $username, $password);
        case 'arangodb':
            return new Connection(
                [
                    ConnectionOptions::OPTION_AUTH_TYPE => 'Basic',
                    ConnectionOptions::OPTION_CONNECTION => 'Keep-Alive',
                    ConnectionOptions::OPTION_TIMEOUT => 30,
                    ConnectionOptions::OPTION_RECONNECT => true,
                    ConnectionOptions::OPTION_CREATE => false,
                    ConnectionOptions::OPTION_UPDATE_POLICY => UpdatePolicy::LAST,
                    ConnectionOptions::OPTION_AUTH_USER => getenv('ARANGODB_USERNAME'),
                    ConnectionOptions::OPTION_AUTH_PASSWD => getenv('ARANGODB_PASSWORD'),
                    ConnectionOptions::OPTION_ENDPOINT => getenv('ARANGODB_HOST'),
                    ConnectionOptions::OPTION_DATABASE => getenv('ARANGODB_DB'),
                ]
            );
    }
}

function recreateDatabase($connection, string $driver, string $dbName): void
{
    switch (strtolower($driver)) {
        case 'mysql':
        case 'mariadb':
        case 'postgres':
            $connection->exec("DROP DATABASE IF EXISTS $dbName");
            $connection->exec("CREATE DATABASE $dbName");
            $connection->exec("use $dbName");
            $path = '../vendor/prooph/pdo-event-store/scripts/' . $driver . '/';
            $connection->exec(file_get_contents($path . '01_event_streams_table.sql'));
            $connection->exec(file_get_contents($path . '02_projections_table.sql'));
            break;
        case 'arangodb':
            $result = $connection->get(Urls::URL_COLLECTION . '?excludeSystem=1');

            $collections = json_decode($result->getBody(), true);

            if (count($collections['result']) > 1) {
                execute($connection,
                    null,
                    ...array_map(function ($col) {
                        return DeleteCollection::with($col['name']);
                    }, $collections['result'])
                );
            }

            eventStreamsBatch($connection)->process();
            projectionsBatch($connection)->process();
            break;
        default:
            throw new \RuntimeException(sprintf('Driver "%s" not supported', $driver));
    }
    // give DB some time
    sleep(5);
}

function destroyDatabase($connection, string $driver, string $dbName): void
{
    switch (strtolower($driver)) {
        case 'mysql':
        case 'mariadb':
        case 'postgres':
            $connection->exec("DROP DATABASE IF EXISTS $dbName");
            break;
        case 'arangodb':
            $result = $connection->get(Urls::URL_COLLECTION . '?excludeSystem=1');

            $collections = json_decode($result->getBody(), true);

            if (count($collections['result']) > 1) {
                execute($connection,
                    null,
                    ...array_map(function ($col) {
                        return DeleteCollection::with($col['name']);
                    }, $collections['result'])
                );
            }
            break;
        default:
            throw new \RuntimeException(sprintf('Driver "%s" not supported', $driver));
    }
}

function createEventStore(string $driver, $connection): EventStore
{
    switch (strtolower($driver)) {
        case 'mysql':
            return new MySqlEventStore(
                new FQCNMessageFactory(),
                $connection,
                new MySqlAggregateStreamStrategy()
            );
        case 'mariadb':
            return new MariaDbEventStore(
                new FQCNMessageFactory(),
                $connection,
                new MariaDbAggregateStreamStrategy()
            );
        case 'postgres':
            return new PostgresEventStore(
                new FQCNMessageFactory(),
                $connection,
                new PostgresAggregateStreamStrategy()
            );
        case 'arangodb':
            return new ArangoDbEventStore(
                new FQCNMessageFactory(),
                $connection,
                new ArangoDbAggregateStreamStrategy()
            );
    }
}

function createProjectionManager(EventStore $eventStore, string $driver, $connection): ProjectionManager
{
    switch (strtolower($driver)) {
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
                $connection
            );
    }
}

function createConnections(): array
{
    if ($driver = getenv('DRIVER')) {
        return [$driver => createConnection($driver)];
    }

    return [
        'mysql' => createConnection('mysql'),
        'mariadb' => createConnection('mariadb'),
        'postgres' => createConnection('postgres'),
        'arangodb' => createConnection('arangodb'),
    ];
}

function createEventStores(array $connections): array
{
    if ($driver = getenv('DRIVER')) {
        return [$driver => createEventStore($driver, $connections[$driver])];
    }

    return [
        'mysql' => createEventStore('mysql', $connections['mysql']),
        'mariadb' => createEventStore('mariadb', $connections['mariadb']),
        'postgres' => createEventStore('postgres', $connections['postgres']),
        'arangodb' => createEventStore('arangodb', $connections['arangodb']),
    ];
}

function createProjectionManagers(array $eventStores, array $connections): array
{
    if ($driver = getenv('DRIVER')) {
        return [$driver => createProjectionManager($eventStores[$driver], $driver, $connections[$driver])];
    }

    return [
        'mysql' => createProjectionManager($eventStores['mysql'], 'mysql', $connections['mysql']),
        'mariadb' => createProjectionManager($eventStores['mariadb'], 'mariadb', $connections['mariadb']),
        'postgres' => createProjectionManager($eventStores['postgres'], 'postgres', $connections['postgres']),
        'arangodb' => createProjectionManager($eventStores['arangodb'], 'arangodb', $connections['arangodb']),
    ];
}

function createTestEvent(array $payload, int $version)
{
    return TestDomainEvent::with($payload, $version);
}

function createTestStreamName()
{
    return new StreamName(uniqid('stream'));
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
