<?php

namespace LaravelEnso\Discussions\app\Http\Controllers\Discussion;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Http\Requests\ValidateDiscussionStore;
use LaravelEnso\Discussions\app\Http\Resources\Discussion as Resource;

class Store extends Controller
{
    public function __invoke(ValidateDiscussionStore $request)
    {
        return new Resource(
            Discussion::create($request->validated())
                ->load([
                    'createdBy.avatar', 'reactions.createdBy.avatar', 'replies.createdBy.avatar',
                    'replies.reactions.createdBy.avatar',
                ])
        );
    }
}
