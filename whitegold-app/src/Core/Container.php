<?php

namespace Blaze\Core;


class Container
{
	private $bindings = [];

	public function set($abstract, callable $factory) : Container
	{
		$this->bindings[$abstract] = $factory;
		return $this;
	}

	public function get($abstract)
	{
		return $this->bindings[$abstract]($this);
	}
}
