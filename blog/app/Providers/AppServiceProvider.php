<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("Collaborator", function()
        {
            return new \App\Collaborator();
        });

        app()->singleton("Example", function()
        {
            return new \App\Example(resolve('Collaborator'), 'foobar');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
