<?php

namespace LaravelEnso\Discussions\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Discussions\app\Models\Traits\Reactable;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;

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
        return Auth::check()
            && Auth::user()->can('handle', $this);
    }
}
