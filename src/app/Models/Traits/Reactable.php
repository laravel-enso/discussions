<?php

namespace LaravelEnso\Discussions\app\Models\Traits;

use LaravelEnso\Discussions\app\Enums\Reactions;
use LaravelEnso\Discussions\app\Models\Reaction;

trait Reactable
{
    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    public function claps()
    {
        return $this->morphMany(Reaction::class, 'reactable')
            ->whereType(Reactions::Clap);
    }
}
