<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Discussions\Http\Controllers\Discussion\Index;
use LaravelEnso\Discussions\Http\Controllers\Discussion\Store;
use LaravelEnso\Discussions\Http\Controllers\Discussion\Update;
use LaravelEnso\Discussions\Http\Controllers\Discussion\Destroy;

Route::get('', Index::class)->name('index');
Route::post('', Store::class)->name('store');
Route::patch('{discussion}', Update::class)->name('update');
Route::delete('{discussion}', Destroy::class)->name('destroy');
