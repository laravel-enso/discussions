<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Discussions\Http\Controllers\Reaction\React;

Route::post('react', React::class)->name('react');
