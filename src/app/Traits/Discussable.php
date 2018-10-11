<?php

namespace LaravelEnso\Discussions\app\Traits;

use LaravelEnso\Discussions\app\Models\Discussion;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

trait Discussable
{
    public static function bootDiscussable()
    {
        self::deleting(function ($model) {
            if (config('enso.discussions.onDelete') === 'restrict'
                && $model->discussions()->first() !== null) {
                throw new ConflictHttpException(
                    __('The entity has discussions and cannot be deleted')
                );
            }
        });

        self::deleted(function ($model) {
            if (config('enso.discussions.onDelete') === 'cascade') {
                $model->discussions()->delete();
            }
        });
    }

    public function discussions()
    {
        return $this->morphMany(Discussion::class, 'discussable');
    }
}
