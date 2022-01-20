<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

use FinanceApp\Route\Router;

require __DIR__ . '/vendor/autoload.php';

session_start();

try {
    $router = new Router();
    require __DIR__ . '/routes/api.php';
} catch (Exception $e) {
    echo 'Error on bootstrap application: ' . $e->getMessage();
}
