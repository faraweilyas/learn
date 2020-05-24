<?php

$route->get('/', function($request, $response)
{
	dump($request, $response);
	$response->getBody()->write('<h1>Hello, World!</h1>');

	return $response;
});
