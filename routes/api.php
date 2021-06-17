<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth', 'core', 'xss-sanitizer:body'])
    ->prefix('api/core/discussions')->as('core.discussions.')
    ->group(function () {
        require __DIR__.'/app/discussions.php';
        require __DIR__.'/app/reactions.php';
        require __DIR__.'/app/replies.php';
    });
