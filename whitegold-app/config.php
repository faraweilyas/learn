<?php

use Blaze\Core\Router;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

return [
	'database.host'     	=> 'localhost',
    'database.port'     	=> 5000,
    'report.recipients' 	=> ['bob@example.com', 'alice@example.com'],
	Request::class 			=> DI\autowire(),
	Response::class 		=> DI\autowire(),
	Router::class 			=> DI\autowire(),
    'FooBar' 				=> DI\factory(function (ContainerInterface $container) {
        return new Foo($container->get('database.host'));
    }),
	Foo::class 				=> function (ContainerInterface $container) {
        return new Foo($container->get('database.host'));
    },
    LoggerInterface::class 	=> DI\create(MyLogger::class),
    FooLogger::class 		=> function (LoggerInterface $logger) {
        return new FooLogger($logger);
    },
    Database::class			=> DI\factory(function ($host) {
    	return new Database($host);
    })->parameter('host', DI\get('database.host')),
];
