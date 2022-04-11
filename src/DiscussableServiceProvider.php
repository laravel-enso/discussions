<?php

namespace LaravelEnso\Discussions;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\Discussions\DynamicRelations\Discussable as Relation;
use LaravelEnso\Discussions\Observers\Observer;
use LaravelEnso\DynamicMethods\Services\Methods;

class DiscussableServiceProvider extends ServiceProvider
{
    protected array $register = [];

    public function boot()
    {
        Collection::wrap($this->register)
            ->each(function ($model) {
                Methods::bind($model, [Relation::class]);
                $model::observe(Observer::class);
            });
    }
}
