<?php

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use Dotenv\Dotenv;
use Prooph\Common\Messaging\Message;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Exception\StreamNotFound;
// this exception is needed, otherwise class is not found
use Prooph\EventStore\Pdo\Exception\RuntimeException;
use Prooph\EventStore\Projection\ProjectionManager;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Ramsey\Uuid\Uuid;

chdir(__DIR__);

$autoloader = require '../vendor/autoload.php';
require 'functions.php';

$realWorldTest = true;

if (version_compare(PHP_VERSION, '7.2.0beta') < 0) {
    echo 'Your PHP Version is ' . PHP_VERSION . ', so "real-world-test" is skipped' . "\n\n";
    $realWorldTest = false;
}

if (! extension_loaded('pthreads')) {
    echo 'You don\'t have pthreads installed, so "real-world-test" is skipped' . "\n\n";
    $realWorldTest = false;
}

// patching pdo-event-store projector (see: https://github.com/krakjoe/pthreads/issues/760)
if ($realWorldTest) {
    $filename = '../vendor/prooph/pdo-event-store/src/Projection/PdoEventStoreProjector.php';
    $content = file_get_contents($filename);
    $newContent = str_replace('private const', 'const', $content);
    file_put_contents($filename, $newContent);

    $filenameConnectionOptions = '../vendor/triagens/arangodb/lib/ArangoDBClient/ConnectionOptions.php';
    $contentConnectionOptions = file_get_contents($filenameConnectionOptions);
    $newContentConnectionOptions = str_replace('DefaultValues::DEFAULT_CIPHERS', 'null', $contentConnectionOptions);
    file_put_contents($filenameConnectionOptions, $newContentConnectionOptions);

    $filenameArangoDbEventStore = '../vendor/prooph/arangodb-event-store/src/EventStore.php';
    $contentArangoDbEventStore = file_get_contents($filenameArangoDbEventStore);
    $newContentArangoDbEventStore = str_replace('private const', 'const', $contentArangoDbEventStore);
    file_put_contents($filenameArangoDbEventStore, $newContentArangoDbEventStore);
}

$dotenv = new Dotenv('..');
$dotenv->load();

$connections = createConnections();
$dbNames = testDatabases();
$payload = testPayload();

register_shutdown_function(function () use ($connections, $dbNames) {
    foreach ($connections as $name => $connection) {
        echo "$name: destroying test-database $dbNames[$name]\n";
        destroyDatabase($connection, $name,  $dbNames[$name]);
    }
});

foreach ($connections as $name => $connection) {
    echo "$name: recreating test-database $dbNames[$name]\n";
    recreateDatabase($connection, $name,  $dbNames[$name]);
}

echo "\n";

$eventStores = createEventStores($connections);
$projectionManagers = createProjectionManagers($eventStores, $connections);

// test 1 - create 10 streams with 100 events in each stream, using 1 event per commit

echo "test 1 create 10 streams with 100 events in each stream, using 1 event per commit\n\n";

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = microtime(true);
    for ($i = 0; $i < 10; $i++) {
        $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());
        $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray([createTestEvent($payload, 1)])));
        $streamNamesTest1[$name][] = $streamName;
        for ($v = 2; $v <= 100; $v++) {
            $eventStore->appendTo($streamName, \SplFixedArray::fromArray([createTestEvent($payload, $v)]));
        }
    }
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 1000 / $time;

    echo "test 1 using $name took $time seconds\n";
    echo "test 1 using $name writes $eventsPerSecond events per second\n\n";
}

// test 2 - create 10 streams with 100 events in each stream, using 5 events per commit

echo "test 2 create 10 streams with 100 events in each stream, using 5 events per commit\n\n";

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = microtime(true);
    for ($i = 0; $i < 10; $i++) {
        $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());
        $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray(createTestEvents($payload, 5))));
        $fromVersion = 5;
        for ($v = 6; $v <= 19; $v++) {
            $events = createTestEvents($payload, 5, $fromVersion);
            $eventStore->appendTo($streamName, \SplFixedArray::fromArray($events));
            $fromVersion += 5;
        }
    }
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 1000 / $time;

    echo "test 2 using $name took $time seconds\n";
    echo "test 2 using $name writes $eventsPerSecond events per second\n\n";
}

// test 3 - create one stream with 2500 events using a single commit

echo "test 3 create one stream with 2500 events using a single commit\n\n";

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = microtime(true);
    $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());
    $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray(createTestEvents($payload, 2500))));
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 2500 / $time;

    echo "test 3 using $name took $time seconds\n";
    echo "test 3 using $name writes $eventsPerSecond events per second\n\n";

    $streamNamesTest3[$name] = $streamName;
}

// test 4 - load one stream with 2500 events
// $streamNames are reused from test 3

echo "test 4 load one stream with 2500 events\n\n";

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = microtime(true);
    $eventStore->load($streamNamesTest3[$name]);
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 2500 / $time;

    echo "test 4 using $name took $time seconds\n";
    echo "test 4 using $name loads $eventsPerSecond events per second\n\n";
}

// test 5 - project 1 stream with 2500 events
// $streamNames are reused from test 3

echo "test 5 project 1 stream with 2500 events\n\n";

foreach ($projectionManagers as $name => $projectionManager) {
    /* @var ProjectionManager $projectionManager */
    $projection = $projectionManager->createProjection('test_projection');
    $projection
        ->init(function (): array {
            return ['count' => 0];
        })
        ->fromStream($streamNamesTest3[$name]->toString())
        ->whenAny(function (array $state, Message $event): array {
            $state['count']++;

            return $state;
        });
    $start = microtime(true);
    $projection->run(false);
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 2500 / $time;

    echo "test 5 using $name took $time seconds\n";
    echo "test 5 using $name loads $eventsPerSecond events per second\n\n";
}

// test 6 - project 10 streams with 100 events each
// $streamNames are reused from test 1

echo "test 6 project 10 stream with 100 events\n\n";

foreach ($projectionManagers as $name => $projectionManager) {
    /* @var ProjectionManager $projectionManager */
    $streamNames = [];
    foreach ($streamNamesTest1[$name] as $streamName) {
        $streamNames[] = $streamName->toString();
    }
    $projection = $projectionManager->createProjection('test_projection');
    $projection
        ->init(function (): array {
            return ['count' => 0];
        })
        ->fromStreams(...$streamNames)
        ->whenAny(function (array $state, Message $event): array {
            $state['count']++;

            return $state;
        });
    $start = microtime(true);
    $projection->run(false);
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 1000 / $time;

    echo "test 6 using $name took $time seconds\n";
    echo "test 6 using $name loads $eventsPerSecond events per second\n\n";
}

if (! $realWorldTest) {
    echo "real-world-test skipped\n\n";
    exit(0);
}

// test 7 - real world test

test7:

echo "test 7 real world test\n\n";

// loading classes for pthreads
$autoloader->loadClass(StreamNotFound::class);

foreach ($connections as $name => $connection) {
    echo "$name: recreating test-database $dbNames[$name]\n";
}

echo "\n";

foreach ($connections as $driver => $connection) {
    echo "starting benchmarks for $driver\n\n";

    $writers = [];
    $projectors = [];

    for ($i = 0; $i < 10; $i++) {
        $writers[] = new StreamCreator($driver, 'user', 50, 5);
        $writers[] = new StreamCreator($driver, 'post', 50, 5);
        $writers[] = new StreamCreator($driver, 'todo', 50, 5);
        $writers[] = new StreamCreator($driver, 'blog', 50, 5);
        $writers[] = new StreamCreator($driver, 'comment', 50, 5);
    }

    $projectors[] = new CategoryProjector($driver, 'user', 2500);
    $projectors[] = new CategoryProjector($driver, 'post', 2500);
    $projectors[] = new CategoryProjector($driver, 'todo', 2500);
    $projectors[] = new CategoryProjector($driver, 'blog', 2500);
    $projectors[] = new CategoryProjector($driver, 'comment', 2500);
    $projectors[] = new AllProjector($driver, 12500);

    $startWriters = microtime(true);
    foreach ($writers as $writer) {
        $writer->start();
    }

    $startProjectors = microtime(true);
    foreach ($projectors as $projector) {
        $projector->start();
    }

    foreach ($writers as $writer) {
        $writer->join();
    }
    $endWriters = microtime(true);

    foreach ($projectors as $projector) {
        $projector->join();
    }
    $endProjectors = microtime(true);

    echo "\ndone.\n";
    $avgWriters = 12500 / ($endWriters - $startWriters);
    $avgReaders = 25000 / ($endProjectors - $startProjectors);
    echo "$driver avg writes $avgWriters events/second\n";
    echo "$driver avg reads $avgReaders events/second\n\n";
}

// revert patching of pdo-event-store projector
file_put_contents($filename, $content);
file_put_contents($filenameArangoDbEventStore, $contentArangoDbEventStore);
file_put_contents($filenameConnectionOptions, $contentConnectionOptions);

echo "all finished\n";
