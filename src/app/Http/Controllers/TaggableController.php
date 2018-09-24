<?php

namespace LaravelEnso\Discussions\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Discussions\app\Http\Responses\TaggableUsers;

class TaggableController extends Controller
{
    public function __invoke()
    {
        return new TaggableUsers();
    }
}
