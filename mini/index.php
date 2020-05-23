<?php

error_reporting(E_ALL);

use App\Controllers\HomeController;
use App\Controllers\UserController;

require_once 'vendor/autoload.php';

$app = new App\App;

$container = $app->getContainer();

$container['config'] = function()
{
	return [
		'db_driver' => 'mysql',
		'db_host' => '127.0.0.1',
		'db_name' => 'oophp',
		'db_user' => 'root',
		'db_password' => '',
	];
};

$container['db'] = function($container)
{
	return new PDO(
		$container->config['db_driver'].':host='.$container->config['db_host'].';dbname='.$container->config['db_name']
		, $container->config['db_user']
		, $container->config['db_password']
	);
};

$container['errorHandler'] = function()
{
	return function($response) {
		return $response
			->withBody("404 Error! Page not found!")
			->withStatus(404);
	};
};

$app->get('/', [HomeController::class, 'index']);

$app->get('/names', [new UserController($container->db), 'names']);

$app->post('/signup', function($response)
{
	return 'Sign up';
});

$app->group('/api', function($app)
{

	$app->get('/user', HomeController::class."::user");

	$app->get('/user/id', HomeController::class."::userId");

	$app->get('/user/gender', HomeController::class."::userGender");

	$app->get('/user/name', HomeController::class."::userName");

	$app->post('/user/new', HomeController::class."::userNew");

	$app->map('/users', function($response)
	{
		return 'Users';
	}, ['GET', 'POST']);

});

$app->run();

