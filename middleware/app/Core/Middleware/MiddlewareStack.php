<?php

namespace App\Core\Middleware;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Middleware\Middleware;

class MiddlewareStack
{
    protected $start;

    public function __construct()
    {
        $this->start = function(Request $request, Response $response)
        {
            dump("start middleware");

            return [$request, $response];
        };
    }

    public function add(Middleware $middleware)
    {
        $next = $this->start;

        $this->start = function(Request $request, Response $response) use ($middleware, $next)
        {
            return $middleware($request, $response, $next);
        };
    }

    public function handle(Request $request, Response $response)
    {
        return call_user_func($this->start, $request, $response);
    }
}
