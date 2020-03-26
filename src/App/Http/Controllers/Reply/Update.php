<?php

namespace LaravelEnso\Discussions\App\Http\Controllers\Reply;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\App\Http\Requests\ValidateReplyRequest;
use LaravelEnso\Discussions\App\Http\Resources\Reply as Resource;
use LaravelEnso\Discussions\App\Models\Reply;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateReplyRequest $request, Reply $reply)
    {
        $this->authorize('handle', $reply);

        $reply->update($request->validated());

        return new Resource($reply->load('createdBy.avatar', 'reactions.createdBy.avatar'));
    }
}
