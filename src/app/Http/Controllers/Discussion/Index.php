<?php

namespace LaravelEnso\Discussions\app\Http\Controllers\Discussion;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Http\Requests\ValidateDiscussionFetch;
use LaravelEnso\Discussions\app\Http\Resources\Discussion as Resource;
use LaravelEnso\Discussions\app\Models\Discussion;

class Index extends Controller
{
    public function __invoke(ValidateDiscussionFetch $request)
    {
        return Resource::collection(
            Discussion::with([
                'createdBy.avatar', 'reactions.createdBy.avatar', 'replies.createdBy.avatar',
                'replies.reactions.createdBy.avatar',
                // 'taggedUsers',
            ])->latest()
            ->for($request->validated())
            ->get()
        );
    }
}
