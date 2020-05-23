<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Exceptions\MethodNotAllowedException;

class Router
{
	protected $path;

	protected $routes = [];

	protected $methods = [];

    public function setPath(string  $path='/')
    {
        $this->path = $path;
        return $this;
    }

    public function addRoute($uri, $handler, array $methods=['GET'])
    {
        $this->routes[$uri] 	= $handler;
        $this->methods[$uri] 	= $methods;
        return $this;
    }

    public function getHandler()
    {
    	if (!isset($this->routes[$this->path])) {
    		throw new RouteNotFoundException('No route found for: '.$this->path);
    	}

    	if (!in_array($_SERVER['REQUEST_METHOD'], $this->methods[$this->path])) {
    		throw new MethodNotAllowedException('Method not allowed');
    	}

        return $this->routes[$this->path];
    }

    public function getRoutes() : array
    {
        return $this->routes;
    }
    
    public function getMethods() : array
    {
        return $this->methods;
    }
}
