<?php

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use PDO;
use Prooph\Common\Messaging\FQCNMessageFactory;
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

function testDatabases(): array
{
    return [
        'mysql' => getenv('MYSQL_DB'),
        'mariadb' => getenv('MARIADB_DB'),
        'postgres' => getenv('POSTGRES_DB'),
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

            return new PDO("mysql:host=$host;port=$port;dbname=$dbName;charset=$charset;", $username, $password);
        case 'mariadb':
            $host = getenv('MARIADB_HOST');
            $port = getenv('MARIADB_PORT');
            $dbName = getenv('MARIADB_DB');
            $charset = getenv('MARIADB_CHARSET');
            $username = getenv('MARIADB_USER');
            $password = getenv('MARIADB_PASSWORD');

            return new PDO("mysql:host=$host;port=$port;dbname=$dbName;charset=$charset", $username, $password);
        case 'postgres':
            $host = getenv('POSTGRES_HOST');
            $port = getenv('POSTGRES_PORT');
            $dbName = getenv('POSTGRES_DB');
            $charset = getenv('POSTGRES_CHARSET');
            $username = getenv('POSTGRES_USER');
            $password = getenv('POSTGRES_PASSWORD');

            return new PDO("pgsql:host=$host;port=$port;dbname=$dbName;options='--client_encoding=\"$charset\"'", $username, $password);
    }
}

function recreateDatabase(Pdo $pdo, string $driver, string $dbName): void
{
    switch (strtolower($driver)) {
        case 'mysql':
        case 'mariadb':
        case 'postgres':
            $pdo->exec("DROP DATABASE IF EXISTS $dbName");
            $pdo->exec("CREATE DATABASE $dbName");
            $pdo->exec("use $dbName");
            $path = '../vendor/prooph/pdo-event-store/scripts/' . $driver . '/';
            $pdo->exec(file_get_contents($path . '01_event_streams_table.sql'));
            $pdo->exec(file_get_contents($path . '02_projections_table.sql'));
            break;
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
    }
}

function createConnections(): array
{
    return [
        'mysql' => createConnection('mysql'),
        'mariadb' => createConnection('mariadb'),
        'postgres' => createConnection('postgres'),
    ];
}

function createEventStores(array $connections): array
{
    return [
        'mysql' => createEventStore('mysql', $connections['mysql']),
        'mariadb' => createEventStore('mariadb', $connections['mariadb']),
        'postgres' => createEventStore('postgres', $connections['postgres']),
    ];
}

function createProjectionManagers(array $eventStores, array $connections): array
{
    return [
        'mysql' => createProjectionManager($eventStores['mysql'], 'mysql', $connections['mysql']),
        'mariadb' => createProjectionManager($eventStores['mariadb'], 'mariadb', $connections['mariadb']),
        'postgres' => createProjectionManager($eventStores['postgres'], 'postgres', $connections['postgres']),
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
