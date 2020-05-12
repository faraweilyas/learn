<?php

namespace Blaze\Core;

/**
 * Blaze\Core\Facade
 */
abstract class Facade
{
    /**
     * Handle dynamic, static calls to the object.
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
    	static::getFacadeAccessor();
    	dump($method, $args);
    	// return $container->get(static::getFacadeAccessor())->{$method}($args);
    }

    public static function getFacadeAccessor()
    {
    	return get_called_class();
    }
}
