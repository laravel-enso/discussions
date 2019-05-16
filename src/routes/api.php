<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core/discussions')->as('core.discussions.')
    ->namespace('LaravelEnso\Discussions\app\Http\Controllers')
    ->group(function () {
        Route::namespace('Discussion')
            ->group(function () {
                Route::get('', 'Index')->name('index');
                Route::post('', 'Store')->name('store');
                Route::patch('{discussion}', 'Update')->name('update');
                Route::delete('{discussion}', 'Destroy')->name('destroy');
            });

        Route::namespace('Reaction')
            ->group(function () {
                Route::post('react', 'React')->name('react');
            });

        Route::namespace('Reply')
            ->group(function () {
                Route::post('storeReply', 'Store')->name('storeReply');
                Route::patch('updateReply/{reply}', 'Update')->name('updateReply');
                Route::delete('destroyReply/{reply}', 'Destroy')->name('destroyReply');
            });
    });
