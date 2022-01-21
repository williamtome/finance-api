<?php

use FinanceApp\Controllers\Interface\BaseController;

require __DIR__ . '/../vendor/autoload.php';
//var_dump($_SERVER);exit();
$path = $_SERVER['REQUEST_URI'];
$routes = require __DIR__ . '/../routes/api.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

$controllerClass = $routes[$path];
/** @var BaseController $controller */
$controller = new $controllerClass();
$controller->processRequest();
