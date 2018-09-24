<?php

namespace LaravelEnso\Discussions\app\Traits;

use LaravelEnso\Discussions\app\Models\Reply;

trait Replies
{
    public function replies()
    {
        return $this->hasMany(Reply::class, 'created_by');
    }
}
