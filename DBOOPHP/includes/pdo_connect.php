<?php

function getError($errors = []) : string
{
	$errorMessage = '';
	array_walk($errors, function($error, $key) use (&$errorMessage)
	{
		$errorMessage .= !empty($error) ? "<p>{$error}</p>" : "";
	});
	return $errorMessage;
}

function connectToMySql()
{
	// $dsn 	= 'mysql:host=localhost;dbname=oophp;port=8889';
	$dsn 	= 'mysql:host=localhost;dbname=oophp';
	$db 	= new PDO($dsn, 'root', '');
	return $db;
}

function connectToSqlLite()
{
	$dsn 	= 'sqlite:/Applications/Ampps/www/learn/DBOOPHP/oophp.db';
	$db 	= new PDO($dsn);
	return $db;
}

try
{
	switch ($config->driver)
	{
		case 'mysql':
			$db = connectToMySql();
			break;
		case 'sqlite':
			$db = connectToSqlLite();
			break;
		default:
			$db = connectToSqlLite();
			break;
	}
} catch(Exception $e)
{
    $error = $e->getMessage();
}

if (!$db) echo "<p>Connection Failed.</p>";

if (isset($error)) echo "<p>$error</p>";
