<?php

Route::namespace('Reaction')
    ->group(function () {
        Route::post('react', 'React')->name('react');
    });
