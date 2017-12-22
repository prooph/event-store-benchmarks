<?php

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use Dotenv\Dotenv;
use Prooph\Common\Messaging\Message;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Projection\ProjectionManager;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Prooph\EventStore\TransactionalEventStore;
use Ramsey\Uuid\Uuid;

chdir(__DIR__);

require '../vendor/autoload.php';
require 'functions.php';

$dotenv = new Dotenv('..');
$dotenv->load();

$connections = createConnections();
$payload = testPayload();

$eventStores = createEventStores($connections);
$projectionManagers = createProjectionManagers($eventStores, $connections);

// test 1 - create 10 streams with 100 events in each stream, using 1 event per commit

outputText("test 1 create 10 streams with 100 events in each stream, using 1 event per commit\n");

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = microtime(true);
    for ($i = 0; $i < 10; $i++) {
        if ($eventStore instanceof TransactionalEventStore) {
            $eventStore->beginTransaction();
        }

        $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());
        $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray([createTestEvent($payload, 1)])));
        $streamNamesTest1[$name][] = $streamName;
        for ($v = 2; $v <= 100; $v++) {
            $eventStore->appendTo($streamName, \SplFixedArray::fromArray([createTestEvent($payload, $v)]));
        }

        if ($eventStore instanceof TransactionalEventStore) {
            $eventStore->commit();
        }
    }
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 1000 / $time;

    outputText("test 1 using $name took $time seconds");
    outputText("test 1 using $name writes $eventsPerSecond events per second\n");
}

// test 2 - create 10 streams with 100 events in each stream, using 5 events per commit

outputText("test 2 create 10 streams with 100 events in each stream, using 5 events per commit\n");

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = microtime(true);
    for ($i = 0; $i < 10; $i++) {
        if ($eventStore instanceof TransactionalEventStore) {
            $eventStore->beginTransaction();
        }

        $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());
        $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray(createTestEvents($payload, 5))));
        $fromVersion = 5;
        for ($v = 6; $v <= 19; $v++) {
            $events = createTestEvents($payload, 5, $fromVersion);
            $eventStore->appendTo($streamName, \SplFixedArray::fromArray($events));
            $fromVersion += 5;
        }

        if ($eventStore instanceof TransactionalEventStore) {
            $eventStore->commit();
        }
    }
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 1000 / $time;

    outputText("test 2 using $name took $time seconds");
    outputText("test 2 using $name writes $eventsPerSecond events per second\n");
}

// test 3 - create one stream with 2500 events using a single commit

outputText("test 3 create one stream with 2500 events using a single commit\n");

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = microtime(true);
    $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());

    if ($eventStore instanceof TransactionalEventStore) {
        $eventStore->beginTransaction();
    }

    $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray(createTestEvents($payload, 2500))));

    if ($eventStore instanceof TransactionalEventStore) {
        $eventStore->commit();
    }

    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 2500 / $time;

    outputText("test 3 using $name took $time seconds");
    outputText("test 3 using $name writes $eventsPerSecond events per second\n");

    $streamNamesTest3[$name] = $streamName;
}

// test 4 - load one stream with 2500 events
// $streamNames are reused from test 3

outputText("test 4 load one stream with 2500 events\n");

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = microtime(true);
    $eventStore->load($streamNamesTest3[$name]);
    $end = microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 2500 / $time;

    outputText("test 4 using $name took $time seconds");
    outputText("test 4 using $name loads $eventsPerSecond events per second\n");
}

// test 5 - project 1 stream with 2500 events
// $streamNames are reused from test 3

outputText("test 5 project 1 stream with 2500 events\n");

foreach ($projectionManagers as $name => $projectionManager) {
    /* @var ProjectionManager $projectionManager */
    $projection = $projectionManager->createProjection('test_projection_5');
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

    outputText("test 5 using $name took $time seconds");
    outputText("test 5 using $name loads $eventsPerSecond events per second\n");
}

// test 6 - project 10 streams with 100 events each
// $streamNames are reused from test 1

outputText("test 6 project 10 stream with 100 events\n");

foreach ($projectionManagers as $name => $projectionManager) {
    /* @var ProjectionManager $projectionManager */
    $streamNames = [];
    foreach ($streamNamesTest1[$name] as $streamName) {
        $streamNames[] = $streamName->toString();
    }
    $projection = $projectionManager->createProjection('test_projection_6');
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

    outputText("test 6 using $name took $time seconds");
    outputText("test 6 using $name loads $eventsPerSecond events per second\n");
}
