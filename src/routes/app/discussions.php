<?php

Route::namespace('Discussion')
    ->group(function () {
        Route::get('', 'Index')->name('index');
        Route::post('', 'Store')->name('store');
        Route::patch('{discussion}', 'Update')->name('update');
        Route::delete('{discussion}', 'Destroy')->name('destroy');
    });
