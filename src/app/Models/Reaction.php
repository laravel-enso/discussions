<?php

namespace LaravelEnso\Discussions\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;

class Reaction extends Model
{
    use CreatedBy;

    protected $fillable = ['reactable_id', 'reactable_type', 'type'];

    public function reactable()
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
