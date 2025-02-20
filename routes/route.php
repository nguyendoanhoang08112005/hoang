<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/helpers/handler.php";

$url=$_GET['url'] ?? '';

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

require_once "web.php";
require_once "admin.php";

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;
