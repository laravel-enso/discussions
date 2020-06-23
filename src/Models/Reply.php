<?php

namespace LaravelEnso\Discussions\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Discussions\Models\Traits\Reactable;
use LaravelEnso\TrackWho\Traits\CreatedBy;

class Reply extends Model
{
    use Reactable, CreatedBy;

    protected $table = 'discussion_replies';

    protected $guarded = ['id'];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
