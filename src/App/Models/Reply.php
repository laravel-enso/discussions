<?php

namespace LaravelEnso\Discussions\App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\Discussions\App\Models\Traits\Reactable;
use LaravelEnso\TrackWho\App\Traits\CreatedBy;

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
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
