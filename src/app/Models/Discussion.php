<?php

namespace LaravelEnso\Discussions\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\Discussions\app\Classes\ConfigMapper;
use LaravelEnso\Discussions\app\Models\Traits\Reactable;

class Discussion extends Model
{
    use Reactable, CreatedBy;

    protected $fillable = ['discussable_id', 'discussable_type', 'title', 'body'];

    protected $appends = ['owner', 'isEditable'];

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

    public function getOwnerAttribute()
    {
        $owner = [
            'fullName' => $this->user->fullName,
            'avatarId' => $this->user->avatarId,
        ];

        unset($this->user);

        return $owner;
    }

    public function getIsEditableAttribute()
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
}
