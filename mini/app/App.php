<?php

namespace App;

use Exception;
use App\Response;

class App
{
	protected $container;

	public function __construct()
	{
		$this->container = new Container([
			'router' => function() {
				return new Router;
			},
			'response' => function() {
				return new Response;
			}
		]);
	}

	public function getContainer()
	{
		return $this->container;
	}

	public function get($uri, $handler)
	{
		$uri 		= $this->getGroupUri($uri);
		$methods 	= $this->getGroupMethods(['GET']);
		return $this->container->router->addRoute($uri, $handler, $methods);
	}

	public function post($uri, $handler)
	{
		$uri 		= $this->getGroupUri($uri);
		$methods 	= $this->getGroupMethods(['POST']);
		return $this->container->router->addRoute($uri, $handler, $methods);
	}

	public function map($uri, $handler, array $methods=['GET'])
	{
		$uri 		= $this->getGroupUri($uri);
		$methods 	= $this->getGroupMethods($methods);
		return $this->container->router->addRoute($uri, $handler, $methods);
	}

	public function group($uri, $handler, array $methods=['GET'])
	{
		$handler($this);
	}

	public function getGroupUri(string $uri) : string
	{
		$debug_backtrace 	= debug_backtrace();
		$groupUri 			= $debug_backtrace[3]['args'][0] ?? "";
		$uri 				= "{$groupUri}{$uri}";
		return $uri;
	}

	public function getGroupMethods(array $methods) : array
	{
		$debug_backtrace 	= debug_backtrace();
		$groupMethods 		= $debug_backtrace[3]['args'][2] ?? ['GET'];
		$methods 			= (!empty($methods) || count($methods) > 0) ? $methods : $groupMethods;
		return $methods;
	}

	public function run()
	{
		$router = $this->container->router;
		$router->setPath($_SERVER['PATH_INFO'] ?? '/');

		try {
			$handler = $router->getHandler();
		} catch (Exception $exception)
		{
			$message = $exception->getMessage();
			if ($this->container->has('errorHandler')) {

				$handler = $this->container->errorHandler;
			} else {
				return;
			}
		}
		return $this->respond($this->process($handler));
	}

	protected function process($callable)
	{
		$response = $this->container->response;

		if (is_array($callable)) {
			if (!is_object($callable[0])) {
				$callable[0] = new $callable[0];
			}

			return call_user_func($callable, $response);
		}

		return $callable($response);
	}

	protected function respond($response)
	{
		if (!$response instanceof Response) {
			echo $response;
			return;
		}

		if (!headers_sent()) {
			header(sprintf(
				"HTTP/%s %s %s"
				, "1.1"
				, $response->getStatusCode()
				, ''
			));
		}

		foreach($response->getHeaders() as $header)
		{
			header($header[0].": ".$header[1]);
		}

		echo $response->getBody();
	}
}
