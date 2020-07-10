<?php

namespace LaravelEnso\Discussions\DynamicRelations;

use Closure;
use LaravelEnso\Discussions\Models\Reply;
use LaravelEnso\DynamicMethods\Contracts\Method;

class Replies implements Method
{
    public function name(): string
    {
        return 'replies';
    }

    public function closure(): Closure
    {
        return fn () => $this->hasMany(Reply::class, 'created_by');
    }
}
