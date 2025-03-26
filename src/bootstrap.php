<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Scandiweb\Database\Connection;

// Load environment variables
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Initialize DB connection as a singleton
$connection = Connection::getInstance();

// Initialize GraphQL
// $graphQLHandler = new Scandiweb\GraphQL\Handler($db);