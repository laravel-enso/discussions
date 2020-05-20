<?php

namespace LaravelEnso\Discussions\App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\Discussions\App\Exceptions\DiscussionConflict;
use LaravelEnso\Discussions\App\Models\Traits\Reactable;
use LaravelEnso\Helpers\App\Traits\AvoidsDeletionConflicts;
use LaravelEnso\Helpers\App\Traits\CascadesMorphMap;
use LaravelEnso\Helpers\App\Traits\UpdatesOnTouch;
use LaravelEnso\TrackWho\App\Traits\CreatedBy;

class Discussion extends Model
{
    use CascadesMorphMap, CreatedBy, Reactable, UpdatesOnTouch, AvoidsDeletionConflicts;

    protected $fillable = ['discussable_id', 'discussable_type', 'title', 'body'];

    protected $touches = ['discussable'];

    public function discussable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
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
        if ($this->replies()->exists()) {
            throw DiscussionConflict::hasReplies();
        }

        return parent::delete();
    }
}
