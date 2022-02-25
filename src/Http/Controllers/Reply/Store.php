<?php

namespace LaravelEnso\Discussions\Http\Controllers\Reply;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\Http\Requests\ValidateReply;
use LaravelEnso\Discussions\Http\Resources\Reply as Resource;
use LaravelEnso\Discussions\Models\Reply;

class Store extends Controller
{
    public function __invoke(ValidateReply $request, Reply $reply)
    {
        $reply->fill($request->validated())->save();

        return new Resource($reply->load('createdBy.avatar', 'reactions'));
    }
}
