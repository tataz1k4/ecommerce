<?php
require __DIR__ . '/vendor/autoload.php';

use Scandiweb\Database\Connection;
use Scandiweb\Database\Seeder;

$pdo = Connection::getInstance()->getPdo();
$seeder = new Seeder($pdo);

try {
    $seeder->run(__DIR__ . '/src/data.json');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit(1);
}