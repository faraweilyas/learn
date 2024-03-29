<?php

namespace App\Providers;

use Zend\Diactoros\Response;
use League\Route\RouteCollection;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AppServiceProvider extends AbstractServiceProvider
{
	protected $provides = [
		RouteCollection::class,
		'response',
		'request',
		'emitter',
	];

	public function register()
	{
		$container = $this->getContainer();

		$container->share(RouteCollection::class, function() use ($container)
		{
			return new RouteCollection($container);
		});

		$container->share("response", Response::class);

		$container->share("request", function()
		{
			return ServerRequestFactory::fromGlobals(
				$_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
			);
		});

		$container->share("emitter", SapiEmitter::class);
	}
}
