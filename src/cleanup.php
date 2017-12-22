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
$dbNames = testDatabases();

foreach ($connections as $name => $connection) {
    outputText("$name: destroying event-store tables on database $dbNames[$name]");
    destroyDatabase($connection, $name,  $dbNames[$name]);
}
