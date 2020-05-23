<?php

namespace App\Controllers;

use PDO;

class HomeController
{
	public function index($response)
	{
		return $response->withBody('Home');
	}

	public static function user($response)
	{
		return $response->withBody('User');
	}

	public static function userId($response)
	{
		return $response->withBody('User ID');
	}

	public static function userGender($response)
	{
		return $response->withBody('User Gender');
	}

	public static function userName($response)
	{
		return $response->withBody('User Name');
	}

	public static function userNew($response)
	{
		return $response->withBody('User New');
	}
}
