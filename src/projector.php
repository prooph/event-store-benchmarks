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

use Dotenv\Dotenv;

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
$name = $argv[1];
$type = $argv[2];

foreach ($connections as $driver => $connection) {
    if ($type === 'all') {
        $projector = new AllProjector($name, $driver, 2500);
        $projector->run();
    } else {
        $projector = new CategoryProjector($name, $driver, $type, 2500);
        $projector->run();
    }
}
