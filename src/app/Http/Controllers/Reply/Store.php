<?php

namespace LaravelEnso\Discussions\app\Http\Controllers\Reply;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Http\Requests\ValidateReplyStore;
use LaravelEnso\Discussions\app\Http\Resources\Reply as Resource;
use LaravelEnso\Discussions\app\Models\Reply;

class Store extends Controller
{
    public function __invoke(ValidateReplyStore $request)
    {
        return new Resource(
            Reply::create($request->validated())
                ->load(['createdBy.avatar', 'reactions'])
        );
    }
}
