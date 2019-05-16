<?php

namespace LaravelEnso\Discussions\app\Http\Controllers\Discussion;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Http\Requests\ValidateDiscussionFetch;
use LaravelEnso\Discussions\app\Http\Resources\Discussion as Resource;

class Index extends Controller
{
    public function __invoke(ValidateDiscussionFetch $request)
    {
        return Resource::collection(
            Discussion::with([
                    'createdBy', 'reactions.createdBy', 'replies.createdBy',
                    'replies.reactions.createdBy',
                    // 'taggedUsers',
                ])->latest()
                ->for($request->validated())
                ->get()
            );
    }
}
