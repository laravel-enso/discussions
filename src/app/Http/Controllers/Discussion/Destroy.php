<?php

namespace LaravelEnso\Discussions\app\Http\Controllers\Discussion;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Models\Discussion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Discussion $discussion)
    {
        $this->authorize('handle', $discussion);

        $discussion->delete();
    }
}
