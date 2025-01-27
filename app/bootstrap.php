<?php

require_once __DIR__.'/../vendor/autoload.php';

$dbParams = [
    'driver' => 'pdo_mysql',
    'host' => getenv('DB_HOST') ?: 'postgres',
    'port' => getenv('DB_PORT') ?: 5432,
    'dbname' => getenv('DB_DATABASE') ?: 'php_ag_db',
    'user' => getenv('DB_USERNAME') ?: 'php_ag_db_user',
    'password' => getenv('DB_PASSWORD') ?: '123456',
];
