<?php

namespace Blaze\Core;

use DI\Container;
use DI\ContainerBuilder;

class Application
{
	public $container;
	private $config = [];

    const APP_SCOPE = '';
    const APP_SCOPES = ["cli-server", "cli"];
	// switch (php_sapi_name())

	public function __construct(array $config)
	{
		$this->config 		= (object) $config;
		$this->container 	= $this->buildDIContainer();
	}

	public function buildDIContainer() : Container
	{
		// dump($this->config);
		// dump($definitions = require $this->config->definitions);
		$containerBuilder = new ContainerBuilder();
		$containerBuilder->useAutowiring($this->config->useAutowiring);
		$containerBuilder->useAnnotations($this->config->useAnnotations);
		$containerBuilder->addDefinitions($this->config->definitions);
		if ($this->config->env == "prod"):
			$containerBuilder->enableCompilation($this->config->compilationDir);
			$containerBuilder->writeProxiesToFile($this->config->writeProxies, $this->config->proxiesDir);
		endif;
		return $containerBuilder->build();
	}

	public function get($abstract)
	{
		return $this->container->get($abstract);
	}

	public function set($abstract, $callable)
	{
		return $this->container->set($abstract, $callable);
	}

    // protected $config;
    // protected $service_provider;
    // protected $service_container;
    // protected $middleware;
    // protected $router;
    // protected $view;
    // protected $event_listeners;
    // protected $event_dispatchers;

    // public function register(string $key, $value) : App;

    // public function bind(string $key) : App;

    // public function bindings() : array;

    // public function resolve(string $key);

    // public function get(string $key);

    // public function app() : App;

    // public function config("filename.key | class::name");

    // public function singleton("filename.key | class::name");

    // public function add();
    
    // public function run();
}
