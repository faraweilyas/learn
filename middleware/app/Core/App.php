<?php

namespace App\Core;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Middleware\Middleware;
use App\Core\Middleware\MiddlewareStack;

class App
{
    protected $middleware;

    public function __construct()
    {
        $this->middleware = new MiddlewareStack();
    }

    public function add(Middleware $middleware)
    {   
        $this->middleware->add($middleware);
    }

    public function run()
    {   
        $result = $this->middleware->handle(new Request(), new Response());
        dump('run app', $result);
    }
}
