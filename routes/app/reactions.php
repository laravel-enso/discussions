<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Reaction')
    ->prefix('reactions')
    ->as('reactions.')
    ->group(function () {
        Route::post('toggle', 'Toggle')->name('toggle');
    });
