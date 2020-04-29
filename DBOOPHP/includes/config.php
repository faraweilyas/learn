<?php

error_reporting(E_ALL);

$config = (object) [

	// Driver is mysql or  sqlite
	"driver" => "mysql",

	"appPath" => "/learn/DBOOPHP/",

];

$config->chapter2 = $config->appPath."chapter2/";
$config->chapter3 = $config->appPath."chapter3/";
$config->chapter4 = $config->appPath."chapter4/";
$config->chapter5 = $config->appPath."chapter5/";
$config->chapter6 = $config->appPath."chapter6/";
$config->chapter7 = $config->appPath."chapter7/";

require_once __DIR__ . '/../vendor/autoload.php';

require_once 'pdo_connect.php';
require_once 'navigation.php';
