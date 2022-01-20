<?php

use FinanceApp\Controller\BaseController;

require __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['PATH_INFO'];
$routes = require __DIR__ . '/../routes/api.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

$controllerClass = $routes[$path];
/** @var BaseController $controller */
$controller = new $controllerClass();
$controller->processRequest();
