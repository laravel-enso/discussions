<?php

namespace LaravelEnso\Discussions\App\Traits;

use LaravelEnso\Discussions\App\Models\Reply;

trait Replies
{
    public function replies()
    {
        return $this->hasMany(Reply::class, 'created_by');
    }
}
