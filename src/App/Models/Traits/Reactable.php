<?php

namespace LaravelEnso\Discussions\App\Models\Traits;

use LaravelEnso\Discussions\App\Enums\Reactions;
use LaravelEnso\Discussions\App\Models\Reaction;

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
