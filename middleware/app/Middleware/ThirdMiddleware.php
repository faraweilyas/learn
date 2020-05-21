<?php

namespace App\Middleware;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Middleware\Middleware;

class ThirdMiddleware implements Middleware
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
    	$nextMiddleware = $next($request, $response);
    	
        dump("third middleware");

        $response->code = 201;

        return $nextMiddleware;
    }
}
