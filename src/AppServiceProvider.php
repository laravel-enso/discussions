<?php

namespace LaravelEnso\Discussions;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Discussions\DynamicsRelations\Discussions;
use LaravelEnso\Discussions\DynamicsRelations\Replies;
use LaravelEnso\Discussions\Models\Discussion;
use LaravelEnso\DynamicMethods\Services\Methods;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->relations()
            ->publish();
    }

    private function load()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/discussions.php', 'enso.discussions');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        return $this;
    }

    private function relations()
    {
        Discussion::morphMap();
        Methods::bind(User::class, [Discussions::class, Replies::class]);

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/../config' => config_path('enso'),
        ], ['discussions-config', 'enso-config']);

        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
        ], ['discussions-factory', 'enso-factories']);
    }
}
