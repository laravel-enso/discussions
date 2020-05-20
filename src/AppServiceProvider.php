<?php

namespace LaravelEnso\Discussions;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\Discussions\App\Models\Discussion;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->mapMorphs()
            ->publish();
    }

    private function load()
    {
        $this->mergeConfigFrom(__DIR__.'/config/discussions.php', 'enso.discussions');

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        return $this;
    }

    private function mapMorphs()
    {
        Relation::morphMap([
            Discussion::morphMapKey() => Discussion::class,
        ]);

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], ['discussions-config', 'enso-config']);

        $this->publishes([
            __DIR__.'/database/factories' => database_path('factories'),
        ], ['discussions-factory', 'enso-factories']);
    }
}
