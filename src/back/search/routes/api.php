<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('social')->group(function () {
    Route::get('/get');
});
Route::prefix('person')->group(function () {
    Route::get('/get');
});
