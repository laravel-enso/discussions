<?php

namespace LaravelEnso\Discussions\App\Http\Controllers\Discussion;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\App\Models\Discussion;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Discussion $discussion)
    {
        $this->authorize('handle', $discussion);

        $discussion->delete();
    }
}
