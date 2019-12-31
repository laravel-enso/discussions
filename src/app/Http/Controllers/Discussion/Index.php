<?php

namespace LaravelEnso\Discussions\App\Http\Controllers\Discussion;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\App\Http\Requests\ValidateDiscussionFetch;
use LaravelEnso\Discussions\App\Http\Resources\Discussion as Resource;
use LaravelEnso\Discussions\App\Models\Discussion;

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
