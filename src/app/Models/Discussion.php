<?php

namespace LaravelEnso\Discussions\app\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\Helpers\app\Traits\UpdatesOnTouch;
use Illuminate\Database\Eloquent\Relations\Relation;
use LaravelEnso\Discussions\app\Models\Traits\Reactable;
use LaravelEnso\Helpers\app\Traits\AvoidsDeletionConflicts;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Discussion extends Model
{
    use CreatedBy, Reactable, UpdatesOnTouch, AvoidsDeletionConflicts;

    protected $fillable = ['discussable_id', 'discussable_type', 'title', 'body'];

    protected $touches = ['discussable'];

    public function discussable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(
            config('auth.providers.users.model'),
            'created_by',
            'id'
        );
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function isEditable()
    {
        return Auth::check()
            && Auth::user()->can('handle', $this);
    }

    public function scopeFor($query, $params)
    {
        $query->whereDiscussableId($params['discussable_id'])
            ->whereDiscussableType(
                Relation::getMorphedModel($params['discussable_type'])
                    ?? $params['discussable_type']
            );
    }

    public function getLoggableMorph()
    {
        return config('enso.discussions.loggableMorph');
    }

    public function delete()
    {
        if ($this->replies()->first() !== null) {
            throw new ConflictHttpException(
                __('The discussion has replies and cannot be deleted')
            );
        }

        return parent::delete();
    }
}
