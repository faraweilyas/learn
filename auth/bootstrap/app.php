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
