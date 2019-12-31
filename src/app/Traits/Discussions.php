<?php

namespace LaravelEnso\Discussions\App\Traits;

use LaravelEnso\Discussions\App\Models\Discussion;

trait Discussions
{
    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'created_by');
    }
}
