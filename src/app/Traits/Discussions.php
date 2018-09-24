<?php

namespace LaravelEnso\Discussions\app\Traits;

use LaravelEnso\Discussions\app\Models\Discussion;

trait Discussions
{
    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'created_by');
    }
}
