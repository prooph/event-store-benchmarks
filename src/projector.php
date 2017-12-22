<?php

declare(strict_types=1);

namespace Prooph\EventStoreBenchmarks;

use Dotenv\Dotenv;

chdir(__DIR__);

require '../vendor/autoload.php';
require 'functions.php';

$dotenv = new Dotenv('..');
$dotenv->load();

$connections = createConnections();
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
