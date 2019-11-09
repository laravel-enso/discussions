<?php

namespace LaravelEnso\Discussions\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Discussions\app\Models\Traits\Reactable;
use LaravelEnso\Helpers\app\Traits\AvoidsDeletionConflicts;
use LaravelEnso\Helpers\app\Traits\UpdatesOnTouch;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
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
            ->whereDiscussableType($params['discussable_type']);
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
