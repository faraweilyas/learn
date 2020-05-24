<?php

use Dotenv\Dotenv;
use League\Route\RouteCollection;
use Dotenv\Exception\InvalidPathException;

session_start();

require_once __DIR__."/../vendor/autoload.php";

try {
	$dotenv = (new Dotenv(__DIR__.'/..//'))->load();
} catch (InvalidPathException $exception)
{
	// 
}

require_once __DIR__.'/container.php';

$route = $container->get(RouteCollection::class);

require_once __DIR__.'/../routes/web.php';

// dump($route, $container->get('request')->getQueryParams());

$response = $route->dispatch($container->get('request'), $container->get('response'));
