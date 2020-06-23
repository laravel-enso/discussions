<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Reaction')
    ->group(function () {
        Route::post('react', 'React')->name('react');
    });
