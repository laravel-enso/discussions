<?php

namespace LaravelEnso\Discussions\Http\Controllers\Reply;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\Http\Requests\ValidateReply;
use LaravelEnso\Discussions\Http\Resources\Reply as Resource;
use LaravelEnso\Discussions\Models\Reply;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateReply $request, Reply $reply)
    {
        $this->authorize('handle', $reply);

        $reply->update($request->validated());

        return new Resource($reply->load('createdBy.avatar', 'reactions.createdBy.avatar'));
    }
}
