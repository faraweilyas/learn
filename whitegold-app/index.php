<?php

use DI\Container;
use App\Facades\Route;
use Blaze\Core\Router;
use Blaze\Core\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/vendor/autoload.php';

$config 				= [
	"env" 				=> 'dev', // dev | prod
	"APP_ENV" 			=> 'dev', // dev | prod
	"APP_DEBUG" 		=> FALSE, // false | true
	"definitions" 		=> __DIR__.'/config.php',
	"useAutowiring"  	=> TRUE,
	"useAnnotations"  	=> FALSE,
	"compilationDir" 	=> __DIR__.'/cache',
	"writeProxies"  	=> TRUE,
	"proxiesDir" 		=> __DIR__.'/cache/proxies',
];

$app = new Application($config);
dump(
	$app->container
	, $app->get(Request::class)
	, $app->get(Container::class)
	// , $app->get(Response::class)
	// , $app->get(Router::class)
	// , $app->get('FooBar')
);

// Route::get('/');
// Router::handle();

