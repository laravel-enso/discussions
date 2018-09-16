<?php

namespace LaravelEnso\Discussions\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Discussions\app\Http\Responses\TaggableUsers;

class TaggableController extends Controller
{
    public function __invoke()
    {
        return new TaggableUsers();
    }
}
