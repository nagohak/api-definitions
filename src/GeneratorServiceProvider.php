<?php

namespace DEVJS\ApiDefinitions;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register(): void
    {
        $this->app->singleton(Generator::class, function ($app){
            return app('DEVJS\ApiDefinitions\Generator');
        });
    }

    public function boot(): void
    {
        //
    }

    public function provides()
    {
        return [Generator::class];
    }
}