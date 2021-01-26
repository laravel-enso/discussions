<?php

namespace LaravelEnso\Discussions\Services;

use LaravelEnso\Discussions\DynamicRelations\Discussionable;
use LaravelEnso\Discussions\Observers\Observer;
use LaravelEnso\DynamicMethods\Services\Methods;

class Register
{
    public static function handle(string $model)
    {
        Methods::bind($model, [Discussionable::class]);
        $model::observe(Observer::class);
    }
}
