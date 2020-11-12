<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth', 'core', 'xss-sanitizer:body'])
    ->prefix('api/core/discussions')->as('core.discussions.')
    ->group(function () {
        require 'app/discussions.php';
        require 'app/reactions.php';
        require 'app/replies.php';
    });
