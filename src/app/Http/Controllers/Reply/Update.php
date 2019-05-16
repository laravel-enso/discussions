<?php

namespace LaravelEnso\Discussions\app\Http\Controllers\Reply;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Models\Reply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\Discussions\app\Http\Resources\Reply as Resource;
use LaravelEnso\Discussions\app\Http\Requests\ValidateReplyUpdate;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateReplyUpdate $request, Reply $reply)
    {
        $this->authorize('handle', $reply);

        $reply->update($request->validated());

        return new Resource(
            $reply->load(['createdBy', 'reactions.createdBy'])
        );
    }
}
