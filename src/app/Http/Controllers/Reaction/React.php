<?php

namespace LaravelEnso\Discussions\app\Http\Controllers\Reaction;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Enums\Reactable;
use LaravelEnso\Discussions\app\Models\Reaction;
use LaravelEnso\Discussions\app\Http\Resources\Reaction as Resource;

class React extends Controller
{
    public function __invoke(Request $request)
    {
        $reactable = Reactable::get($request->get('reactableType'))
            ::find($request->get('reactableId'));

        Reaction::toggle($reactable, $request->only(['userId', 'type']));

        return Resource::collection(
            $reactable->reactions()
                ->with(['createdBy.avatar'])
                ->get()
        );
    }
}
