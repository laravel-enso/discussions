<?php

namespace LaravelEnso\Discussions\DynamicsRelations;

use Closure;
use LaravelEnso\Discussions\Models\Discussion;
use LaravelEnso\DynamicMethods\Contracts\Method;

class Discussions implements Method
{
    public function name(): string
    {
        return 'discussions';
    }

    public function closure(): Closure
    {
        return fn () => $this->hasMany(Discussion::class, 'created_by');
    }
}
