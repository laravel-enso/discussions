<?php

Route::namespace('Reply')
    ->group(function () {
        Route::post('storeReply', 'Store')->name('storeReply');
        Route::patch('updateReply/{reply}', 'Update')->name('updateReply');
        Route::delete('destroyReply/{reply}', 'Destroy')->name('destroyReply');
    });
