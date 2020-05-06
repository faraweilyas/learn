<?php

namespace App\Core;


abstract class App
{
    protected $config;
    protected $service_provider;
    protected $service_container;
    protected $middleware;
    protected $router;
    protected $view;
    protected $event_listeners;
    protected $event_dispatchers;

    public function register(string $key, $value) : App;

    public function bind(string $key) : App;

    public function bindings() : array;

    public function resolve(string $key);

    public function get(string $key);

    public function app() : App;

    public function config("filename.key | class::name");

    public function singleton("filename.key | class::name");

    public function add();
    
    public function run();
}
