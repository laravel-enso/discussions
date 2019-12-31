<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core/discussions')->as('core.discussions.')
    ->namespace('LaravelEnso\Discussions\App\Http\Controllers')
    ->group(function () {
        require 'app/discussions.php';
        require 'app/reactions.php';
        require 'app/replies.php';
    });
