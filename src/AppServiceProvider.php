<?php

namespace LaravelEnso\Discussions;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], 'discussions-config');

        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js'),
        ], 'discussions-assets');

        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js'),
        ], 'enso-assets');

        $this->mergeConfigFrom(__DIR__.'/config/discussions.php', 'enso.discussions');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        //
    }
}
