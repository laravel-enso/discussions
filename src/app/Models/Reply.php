<?php

namespace LaravelEnso\Discussions\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\Discussions\app\Models\Traits\Reactable;

class Reply extends Model
{
    use Reactable, CreatedBy;

    protected $table = 'discussion_replies';

    protected $fillable = ['discussion_id', 'body'];

    protected $appends = ['owner', 'isEditable'];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function user()
    {
        return $this->belongsTo(
            config('auth.providers.users.model'),
            'created_by',
            'id'
        );
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
}
