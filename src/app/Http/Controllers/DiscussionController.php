<?php

namespace LaravelEnso\Discussions\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Http\Resources\Discussion as Resource;
use LaravelEnso\Discussions\app\Http\Requests\ValidateDiscussionRequest;

class DiscussionController extends Controller
{
    public function index(ValidateDiscussionRequest $request)
    {
        return Resource::collection(
            Discussion::with([
                    'createdBy', 'reactions.createdBy', 'replies.createdBy',
                    'replies.reactions.createdBy',
                    // 'taggedUsers',
                ])->latest()
                ->for($request->validated())
                ->get()
            );
    }

    public function store(ValidateDiscussionRequest $request, Discussion $discussion)
    {
        return new Resource(
            $discussion->store($request->validated())
                ->load([
                    'createdBy', 'reactions.createdBy', 'replies.createdBy',
                    'replies.reactions.createdBy',
                ])
        );
    }

    public function update(ValidateDiscussionRequest $request, Discussion $discussion)
    {
        $this->authorize('handle', $discussion);

        $discussion->update($request->validated());
    }

    public function destroy(Discussion $discussion)
    {
        $this->authorize('handle', $discussion);

        $discussion->delete();
    }
}
