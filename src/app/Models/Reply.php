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

    public function isEditable()
    {
        return request()->user()
            && request()->user()->can('handle', $this);
    }
}
