<?php

namespace LaravelEnso\Discussions;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->publish();
    }

    private function load()
    {
        $this->mergeConfigFrom(__DIR__.'/config/discussions.php', 'enso.discussions');

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], 'discussions-config');

        $this->publishes([
            __DIR__.'/database/factories' => database_path('factories'),
        ], 'enso-factories');

        $this->publishes([
            __DIR__.'/database/factories' => database_path('factories'),
        ], 'discussions-factory');
    }
}
