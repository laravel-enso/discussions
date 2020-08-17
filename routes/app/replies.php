<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Reply')
    ->prefix('replies')
    ->as('replies.')
    ->group(function () {
        Route::post('store', 'Store')->name('store');
        Route::patch('update/{reply}', 'Update')->name('update');
        Route::delete('destroy/{reply}', 'Destroy')->name('destroy');
    });
