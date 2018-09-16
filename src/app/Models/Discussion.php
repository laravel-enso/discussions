<?php

namespace LaravelEnso\Discussions\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\ActivityLog\app\Traits\LogActivity;
use LaravelEnso\Discussions\app\Classes\ConfigMapper;
use LaravelEnso\Discussions\app\Models\Traits\Reactable;

class Discussion extends Model
{
    use Reactable, CreatedBy, LogActivity;

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

    public function scopeFor($query, $request)
    {
        $query->whereDiscussableId($request['discussable_id'])
            ->whereDiscussableType(
                (new ConfigMapper($request['discussable_type']))
                    ->class()
            );
    }

    public function store($request)
    {
        return $this->create([
            'title' => $request['title'],
            'body' => $request['body'],
            'discussable_id' => $request['discussable_id'],
            'discussable_type' => (new ConfigMapper($request['discussable_type']))
                                    ->class(),
        ]);
    }

    public function getLoggableMorph()
    {
        return config('enso.discussions.loggableMorph');
    }
}
