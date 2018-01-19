<?php

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Prooph\EventStore\TransactionalEventStore;
use Ramsey\Uuid\Uuid;

class StreamCreator
{
    private $id;
    private $eventsWritten;
    private $driver;
    private $category;
    private $executions;
    private $numberOfEvents;

    public function __construct(string $id, string $driver, string $category, int $executions, int $numberOfEvents)
    {
        $this->id = $id;
        $this->eventsWritten = 0;
        $this->driver = $driver;
        $this->category = $category;
        $this->executions = $executions;
        $this->numberOfEvents = $numberOfEvents;
    }

    public function run()
    {
        outputText("Writer $this->id-$this->category started");

        try {
            $connection = createConnection($this->driver);

            $eventStore = createEventStore($this->driver, $connection);

            $start = microtime(true);

            for ($i = 0; $i < $this->executions; $i++) {
                $streamName = $this->category . '-' . Uuid::uuid4()->toString();
                $events = createTestEvents(testPayload(), $this->numberOfEvents);

                if ($eventStore instanceof TransactionalEventStore) {
                    $eventStore->beginTransaction();
                }

                $eventStore->create(new Stream(new StreamName($streamName), \SplFixedArray::fromArray($events)));

                if ($eventStore instanceof TransactionalEventStore) {
                    $eventStore->commit();
                }

                $this->eventsWritten += $this->numberOfEvents;
            }

            $end = microtime(true);

            $time = $end - $start;
            $avg = ($this->executions * $this->numberOfEvents) / $time;

            outputText("Writer $this->id-$this->category wrote $this->eventsWritten events");
            outputText("Writer $this->id-$this->category used $time seconds, avg $avg events/second");
        } catch (\Throwable $e) {
            echo $e->getMessage() . PHP_EOL . $e->getTraceAsString();
        }
    }
}
