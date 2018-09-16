<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core')->as('core.')
    ->namespace('LaravelEnso\Discussions\app\Http\Controllers')
    ->group(function () {
        Route::prefix('discussions')->as('discussions.')
            ->group(function () {
                Route::post('storeReply', 'ReplyController@store')
                    ->name('storeReply');
                Route::patch('updateReply/{reply}', 'ReplyController@update')
                    ->name('updateReply');
                Route::delete('destroyReply/{reply}', 'ReplyController@destroy')
                    ->name('destroyReply');

                Route::post('react', 'ReactionController')
                    ->name('react');

                Route::get('taggableUsers', 'TaggableController')
                    ->name('taggableUsers');
            });

        Route::resource('discussions', 'DiscussionController', [
            'except' => ['edit', 'create'],
        ]);
    });
