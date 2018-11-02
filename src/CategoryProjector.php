<?php

/**
 * This file is part of prooph/pdo-event-store.
 * (c) 2018 prooph software GmbH <contact@prooph.de>
 * (c) 2018 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use Prooph\Common\Messaging\Message;
use Prooph\EventStore\Util\Assertion;
use Ramsey\Uuid\Uuid;

class CategoryProjector
{
    private $id;
    private $driver;
    private $category;
    private $stopAt;

    public function __construct(string $id, string $driver, string $category, int $stopAt)
    {
        $this->id = $id;
        $this->driver = $driver;
        $this->category = $category;
        $this->stopAt = $stopAt;
    }

    public function run()
    {
        outputText("Projection $this->id started");

        try {
            $connection = createConnection($this->driver);
            $eventStore = createEventStore($this->driver, $connection);
            $projectionManager = createProjectionManager($eventStore, $this->driver, $connection);

            $stopAt = $this->stopAt;

            $start = \microtime(true);
            $uuid = Uuid::uuid4()->toString();

            $projection = $projectionManager->createProjection('category_projection_' . $uuid);
            $projection
                ->init(function (): array {
                    return ['count' => 0];
                })
                ->fromCategory($this->category)
                ->whenAny(function (array $state, Message $event) use ($stopAt): array {
                    $state['count']++;
                    if ($state['count'] === $stopAt) {
                        $this->stop();
                    }

                    return $state;
                })
                ->run();

            $readEvents = $projection->getState()['count'];

            $end = \microtime(true);

            $time = $end - $start;
            $avg = $this->stopAt / $time;

            outputText("Projection $this->id read $readEvents events");
            outputText("Projection $this->id used $time seconds, avg $avg events/second");
            outputText("Projection $this->id checking integrity ...", true, '');
            Assertion::eq($readEvents, 2500, 'Number of category projected events invalid: Value "%s" does not equal expected value "%s".');
            outputText(" ok\n", false);
        } catch (\Throwable $e) {
            echo $e->getMessage() . PHP_EOL . $e->getTraceAsString();
        }
    }
}
