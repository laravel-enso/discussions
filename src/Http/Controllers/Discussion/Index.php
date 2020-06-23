<?php

namespace LaravelEnso\Discussions\Http\Controllers\Discussion;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\Http\Requests\ValidateDiscussionFetch;
use LaravelEnso\Discussions\Http\Resources\Discussion as Resource;
use LaravelEnso\Discussions\Models\Discussion;

class Index extends Controller
{
    public function __invoke(ValidateDiscussionFetch $request)
    {
        return Resource::collection(
            Discussion::with([
                'createdBy.avatar', 'reactions.createdBy.avatar', 'replies.createdBy.avatar',
                'replies.reactions.createdBy.avatar', // 'taggedUsers',
            ])->latest()
            ->for($request->validated())
            ->get()
        );
    }
}
