<?php

namespace LaravelEnso\Discussions\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\Traits\CreatedBy;
use LaravelEnso\Users\Models\User;

class Reaction extends Model
{
    use CreatedBy;

    protected $guarded = ['id'];

    public function reactable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public static function toggle($reactable, $attributes)
    {
        $reaction = $reactable->reactions()
            ->whereCreatedBy($attributes['userId'])
            ->first();

        if ($reaction) {
            $reaction->delete();

            return;
        }

        $reactable->reactions()->save(
            new self(['type' => $attributes['type']])
        );
    }
}
