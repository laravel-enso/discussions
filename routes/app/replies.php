<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Discussions\Http\Controllers\Reply\Destroy;
use LaravelEnso\Discussions\Http\Controllers\Reply\Store;
use LaravelEnso\Discussions\Http\Controllers\Reply\Update;

Route::post('storeReply', Store::class)->name('storeReply');
Route::patch('updateReply/{reply}', Update::class)->name('updateReply');
Route::delete('destroyReply/{reply}', Destroy::class)->name('destroyReply');
