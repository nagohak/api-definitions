<?php

namespace DEVJS\ApiDefinitions;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register(): void
    {
        $this->app->singleton(Generator::class, function ($app){
            $property = new Property();
            return new Generator(new ClassFinder(), $property, new DefinitionParser($property));
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
