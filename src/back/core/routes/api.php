<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/login', [ApiController::class, 'login']);
Route::post('/registration', [ApiController::class, 'registration']);
Route::prefix('/socials')->group(function () {
    Route::post('/create', [ApiController::class, 'createNewSocial']);
    Route::post('/join/{socialId}/{userId}', [ApiController::class, 'joinToSocials']);
    Route::get('/getUserSocials/{userId}', [ApiController::class, 'getUserSocials']);
    Route::get('/search/{name}/{userId}', [ApiController::class, 'searchSocials']);
});
Route::prefix('/post')->group(function () {
    Route::post('/create', [ApiController::class, 'createPost']);
    Route::get('/public/get/{socialId}/{userId}', [ApiController::class, 'getPublicPosts']);
    Route::get('/private/get/{socialId}/{userId}', [ApiController::class, 'getPrivatePosts']);
});
Route::prefix('/user')->group(function () {
    Route::prefix('/{userId}')->group(function () {
        Route::get('/get', [ApiController::class, 'getUser']);
        Route::get('/getAvatar', [ApiController::class, 'getUserAvatar']);
    });
    Route::prefix('/cookie')->group(function () {
        Route::post('/get', [ApiController::class, 'getSession']);
    });
});
Route::match(array('GET', 'POST'),'/ping', function () {
    return 'OK';
});
