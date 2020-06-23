<?php

namespace LaravelEnso\Discussions\Models\Traits;

use LaravelEnso\Discussions\Enums\Reactions;
use LaravelEnso\Discussions\Models\Reaction;

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
