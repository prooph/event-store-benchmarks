<?php

/**
 * This file is part of the prooph/pdo-event-store.
 * (c) 2018 prooph software GmbH <contact@prooph.de>
 * (c) 2018 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use Dotenv\Dotenv;
use Prooph\Common\Messaging\Message;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Projection\ProjectionManager;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Prooph\EventStore\TransactionalEventStore;
use Prooph\EventStore\Util\Assertion;
use Ramsey\Uuid\Uuid;

\chdir(__DIR__);

require '../vendor/autoload.php';
require 'functions.php';

$dotenv = new Dotenv('..');
$dotenv->load();

if (false === ($drivers = \getenv('DRIVER'))) {
    throw new \RuntimeException('No DRIVER environment variable set.');
}
if (false === ($strategy = \getenv('STREAM_STRATEGY'))) {
    throw new \RuntimeException('No STREAM_STRATEGY environment variable set.');
}

$connections = createConnections(\explode(',', $drivers));
$payload = testPayload();

$eventStores = createEventStores($connections);
$projectionManagers = createProjectionManagers($eventStores, $connections);

$numberStreams = [];
$numberEvents = [];

// test 1 - create 10 streams with 100 events in each stream, using 1 event per commit

outputText("test 1 create 10 streams with 100 events in each stream, using 1 event per commit\n");

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $numberStreams[$name] = 0;
    $numberEvents[$name] = 0;
    $start = \microtime(true);
    for ($i = 0; $i < 10; $i++) {
        $numberStreams[$name]++;
        $numberEvents[$name]++;
        if ($eventStore instanceof TransactionalEventStore) {
            $eventStore->beginTransaction();
        }

        $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());
        $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray([createTestEvent($payload, 1)])));
        $streamNamesTest1[$name][] = $streamName;
        for ($v = 2; $v <= 100; $v++) {
            $numberEvents[$name]++;
            $eventStore->appendTo($streamName, \SplFixedArray::fromArray([createTestEvent($payload, $v)]));
        }

        if ($eventStore instanceof TransactionalEventStore) {
            $eventStore->commit();
        }
    }
    $end = \microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 1000 / $time;

    outputText("test 1 using $name took $time seconds");
    outputText("test 1 using $name writes $eventsPerSecond events per second");
    outputText('test 1 checking integrity ...', true, '');
    checkWriteIntegrity($eventStore, $numberStreams[$name], $numberEvents[$name]);
    outputText(" ok\n", false);
}

// test 2 - create 10 streams with 100 events in each stream, using 5 events per commit

outputText("test 2 create 10 streams with 100 events in each stream, using 5 events per commit\n");

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = \microtime(true);
    for ($i = 0; $i < 10; $i++) {
        $numberStreams[$name]++;
        $numberEvents[$name] += 5;
        if ($eventStore instanceof TransactionalEventStore) {
            $eventStore->beginTransaction();
        }

        $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());
        $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray(createTestEvents($payload, 5))));
        $fromVersion = 5;
        for ($v = 6; $v <= 24; $v++) {
            $numberEvents[$name] += 5;
            $events = createTestEvents($payload, 5, $fromVersion);
            $eventStore->appendTo($streamName, \SplFixedArray::fromArray($events));
            $fromVersion += 5;
        }

        if ($eventStore instanceof TransactionalEventStore) {
            $eventStore->commit();
        }
    }
    $end = \microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 1000 / $time;

    outputText("test 2 using $name took $time seconds");
    outputText("test 2 using $name writes $eventsPerSecond events per second");
    outputText('test 2 checking integrity ...', true, '');
    checkWriteIntegrity($eventStore, $numberStreams[$name], $numberEvents[$name]);
    outputText(" ok\n", false);
}

// test 3 - create one stream with 2500 events using a single commit

outputText("test 3 create one stream with 2500 events using a single commit\n");

foreach ($eventStores as $name => $eventStore) {
    $number = 2500;
    /* @var EventStore $eventStore */
    $numberStreams[$name]++;
    $numberEvents[$name] += $number;
    $start = \microtime(true);
    $streamName = new StreamName('stream_' . Uuid::uuid4()->toString());

    if ($eventStore instanceof TransactionalEventStore) {
        $eventStore->beginTransaction();
    }

    $eventStore->create(new Stream($streamName, \SplFixedArray::fromArray(createTestEvents($payload, $number))));

    if ($eventStore instanceof TransactionalEventStore) {
        $eventStore->commit();
    }

    $end = \microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 2500 / $time;

    outputText("test 3 using $name took $time seconds");
    outputText("test 3 using $name writes $eventsPerSecond events per second\n");
    outputText('test 3 checking integrity ...', true, '');
    checkWriteIntegrity($eventStore, $numberStreams[$name], $numberEvents[$name]);
    outputText(" ok\n", false);

    $streamNamesTest3[$name] = $streamName;
}

// test 4 - load one stream with 2500 events
// $streamNames are reused from test 3

outputText("test 4 load one stream with 2500 events\n");

foreach ($eventStores as $name => $eventStore) {
    /* @var EventStore $eventStore */
    $start = \microtime(true);
    $events = $eventStore->load($streamNamesTest3[$name]);
    $end = \microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 2500 / $time;

    outputText("test 4 using $name took $time seconds");
    outputText("test 4 using $name loads $eventsPerSecond events per second");
    outputText('test 4 checking integrity ...', true, '');
    Assertion::eq(\iterator_count($events), 2500, 'Number of events invalid: Value "%s" does not equal expected value "%s".');
    outputText(" ok\n", false);
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
    $start = \microtime(true);
    $projection->run(false);
    $end = \microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 2500 / $time;

    outputText("test 5 using $name took $time seconds");
    outputText("test 5 using $name loads $eventsPerSecond events per second");
    outputText('test 5 checking integrity ...', true, '');
    Assertion::eq($projection->getState()['count'], 2500, 'Number of projected events invalid: Value "%s" does not equal expected value "%s".');
    outputText(" ok\n", false);
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
    $start = \microtime(true);
    $projection->run(false);
    $end = \microtime(true);
    $time = $end - $start;
    $eventsPerSecond = 1000 / $time;

    outputText("test 6 using $name took $time seconds");
    outputText("test 6 using $name loads $eventsPerSecond events per second");
    outputText('test 6 checking integrity ...', true, '');
    Assertion::eq($projection->getState()['count'], 1000, 'Number of projected events invalid: Value "%s" does not equal expected value "%s".');
    outputText(" ok\n", false);
}
