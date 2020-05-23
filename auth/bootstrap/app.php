<?php

session_start();

require_once __DIR__."/../vendor/autoload.php";

try {
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..//')->load();
} catch (Dotenv\Exception\InvalidPathException $exception)
{
	// 
}

var_dump(
	getenv('APP_NAME')
	, $_ENV['APP_NAME']
	, $_SERVER['APP_NAME']
);


$container = new League\Container\Container;

$container->add(Acme\Foo::class)->addArgument(Acme\Bar::class);
$container->add(Acme\Bar::class);

$foo = $container->get(Acme\Foo::class);

var_dump($foo instanceof Acme\Foo);      // true
var_dump($foo->bar instanceof Acme\Bar); // true
