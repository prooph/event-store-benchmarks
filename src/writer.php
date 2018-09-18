<?php

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
    $writer = new StreamCreator($name, $driver, $type, 50, 5);
    $writer->run();
}
