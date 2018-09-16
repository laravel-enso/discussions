<?php

namespace LaravelEnso\Discussions\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Discussions\app\Models\Reply;
use LaravelEnso\Discussions\app\Http\Resources\Reply as Resource;
use LaravelEnso\Discussions\app\Http\Requests\ValidateReplyRequest;

class ReplyController extends Controller
{
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
