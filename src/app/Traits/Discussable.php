<?php

namespace LaravelEnso\Discussions\App\Traits;

use LaravelEnso\Discussions\App\Exceptions\DiscussionConflict;
use LaravelEnso\Discussions\App\Models\Discussion;

trait Discussable
{
    public static function bootDiscussable()
    {
        self::deleting(fn ($model) => $model->attemptDiscussableDeletion());

        self::deleted(fn ($model) => $model->cascadeDiscussionDeletion());
    }

    public function discussion()
    {
        return $this->morphOne(Discussion::class, 'discussable');
    }

    public function discussions()
    {
        return $this->morphMany(Discussion::class, 'discussable');
    }

    private function attemptDiscussableDeletion()
    {
        if (config('enso.discussions.onDelete') === 'restrict'
            && $this->discussions()->exists()) {
            throw DiscussionConflict::delete();
        }
    }

    private function cascadeDiscussionDeletion()
    {
        if (config('enso.discussions.onDelete') === 'cascade') {
            $this->discussions()->delete();
        }
    }
}
