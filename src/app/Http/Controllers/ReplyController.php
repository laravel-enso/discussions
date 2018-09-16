<?php

namespace LaravelEnso\Discussions\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Discussions\app\Models\Reply;
use LaravelEnso\Discussions\app\Http\Requests\ValidateReplyRequest;

class ReplyController extends Controller
{
    public function store(ValidateReplyRequest $request)
    {
        return Reply::create($request->validated())
            ->load(['reactions']);
    }

    public function update(ValidateReplyRequest $request, Reply $reply)
    {
        $this->authorize('handle', $reply);

        $reply->update($request->validated());

        return $reply;
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('handle', $reply);

        $reply->delete();
    }
}
