<?php

namespace App\Controllers;

use PDO;

class HomeController
{
	public function index($response)
	{
		return $response->withBody('Home');
	}
}
