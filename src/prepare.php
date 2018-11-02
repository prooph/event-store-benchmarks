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
$dbNames = testDatabases();

foreach ($connections as $name => $connection) {
    outputText("$name: set up event store tables on database $dbNames[$name]");
    createDatabase($connection, $name, $dbNames[$name]);
}

echo "\n";
