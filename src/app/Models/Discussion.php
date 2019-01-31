<?php

namespace LaravelEnso\Discussions\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;
use LaravelEnso\Discussions\app\Models\Traits\Reactable;
use LaravelEnso\Multitenancy\app\Traits\SystemConnection;

class Discussion extends Model
{
    use Reactable, CreatedBy, LogsActivity, SystemConnection;

    protected $fillable = ['discussable_id', 'discussable_type', 'title', 'body'];

    protected $loggableLabel = 'title';

    protected $loggable = ['title', 'body'];

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
        return request()->user()
            && request()->user()->can('handle', $this);
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
}
