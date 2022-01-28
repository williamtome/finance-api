<?php

use Psr\Http\Server\RequestHandlerInterface;

require __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['PATH_INFO'];
$routes = require __DIR__ . '/../routes/api.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();
$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UrlFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$request = $creator->fromGlobals();

$controllerClass = $routes[$path];
/** @var RequestHandlerInterface $controller */
$controller = new $controllerClass();
$response = $controller->handle($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
