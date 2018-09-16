<?php

namespace LaravelEnso\Discussions\app\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use LaravelEnso\Discussions\app\Models\Discussion;

class DiscussionIndex implements Responsable
{
    public function toResponse($request)
    {
        return Discussion::with(['replies.reactions', 'reactions'])
            ->for($request->only([
                'discussable_id', 'discussable_type'
            ]))
            ->latest()
            ->get();
    }
}
