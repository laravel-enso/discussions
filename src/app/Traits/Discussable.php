<?php

namespace LaravelEnso\Discussions\app\Traits;

use LaravelEnso\CommentsManager\app\Models\Discussion;

trait Discussable
{
    public function discussions()
    {
        return $this->morphMany(Discussion::class, 'discussable');
    }
}
