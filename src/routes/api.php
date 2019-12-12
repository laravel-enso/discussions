<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core/discussions')->as('core.discussions.')
    ->namespace('LaravelEnso\Discussions\app\Http\Controllers')
    ->group(function () {
        require 'app/discussions.php';
        require 'app/reactions.php';
        require 'app/replies.php';
    });
