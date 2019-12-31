<?php

namespace LaravelEnso\Discussions\App\Http\Controllers\Reaction;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\App\Enums\Reactable;
use LaravelEnso\Discussions\App\Http\Resources\Reaction as Resource;
use LaravelEnso\Discussions\App\Models\Reaction;

class React extends Controller
{
    public function __invoke(Request $request)
    {
        $reactable = Reactable::get($request->get('reactableType'))
            ::find($request->get('reactableId'));

        Reaction::toggle($reactable, $request->only(['userId', 'type']));

        return Resource::collection(
            $reactable->reactions()->with(['createdBy.avatar'])->get()
        );
    }
}
