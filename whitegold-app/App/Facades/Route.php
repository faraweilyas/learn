<?php

namespace App\Facades;

use Blaze\Core\Facade;

/**
 * App\Facades\Route
 */
class Route extends Facade
{
	public static function getFacadeAccessor()
	{
    	dump(parent::getFacadeAccessor());
		// return get_called_class();
	}
}
