<?php

namespace App\Middleware;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Middleware\Middleware;

class SecondMiddleware implements Middleware
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
        dump("second middleware");

        $response->code = 201;

        return $next($request, $response);
    }
}
