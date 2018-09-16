<?php

namespace LaravelEnso\Discussions\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Http\Responses\DiscussionIndex;
use LaravelEnso\Discussions\app\Http\Requests\ValidateDiscussionRequest;

class DiscussionController extends Controller
{
    public function index()
    {
        return new DiscussionIndex();
    }

    public function store(ValidateDiscussionRequest $request, Discussion $discussion)
    {
        return $discussion->store($request->validated())
            ->load(['replies', 'reactions']);
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
