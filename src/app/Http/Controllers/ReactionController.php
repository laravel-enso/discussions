<?php

namespace LaravelEnso\Discussions\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Discussions\app\Enums\Reactable;
use LaravelEnso\Discussions\app\Models\Reaction;
use LaravelEnso\Discussions\app\Http\Resources\Reaction as Resource;

class ReactionController extends Controller
{
    public function __invoke(Request $request)
    {
        $reactable = Reactable::get($request->get('reactableType'))
            ::find($request->get('reactableId'));

        Reaction::toggle($reactable, $request->only(['userId', 'type']));

        return Resource::collection(
            $reactable->reactions()
                ->with(['createdBy'])
                ->get()
        );
    }
}
