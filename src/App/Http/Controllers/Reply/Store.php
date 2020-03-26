<?php

namespace LaravelEnso\Discussions\App\Http\Controllers\Reply;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\App\Http\Requests\ValidateReplyRequest;
use LaravelEnso\Discussions\App\Http\Resources\Reply as Resource;
use LaravelEnso\Discussions\App\Models\Reply;

class Store extends Controller
{
    public function __invoke(ValidateReplyRequest $request, Reply $reply)
    {
        $reply->fill($request->validated())->save();

        return new Resource($reply->load('createdBy.avatar', 'reactions'));
    }
}
