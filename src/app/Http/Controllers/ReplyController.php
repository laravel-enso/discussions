<?php

namespace LaravelEnso\Discussions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Models\Reply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\Discussions\app\Http\Resources\Reply as Resource;
use LaravelEnso\Discussions\app\Http\Requests\ValidateReplyRequest;

class ReplyController extends Controller
{
    use AuthorizesRequests;

    public function store(ValidateReplyRequest $request)
    {
        return new Resource(
            Reply::create($request->validated())
                ->load(['createdBy', 'reactions'])
        );
    }

    public function update(ValidateReplyRequest $request, Reply $reply)
    {
        $this->authorize('handle', $reply);

        $reply->update($request->validated());

        return new Resource(
            $reply->load(['createdBy', 'reactions.createdBy'])
        );
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('handle', $reply);

        $reply->delete();
    }
}
