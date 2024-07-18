<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'registration']);
Route::prefix('/socials')->group(function () {
    Route::post('/create', [SocialController::class, 'createNewSocial']);
    Route::post('/join/{socialId}/{userId}', [SocialController::class, 'joinToSocials']);
    Route::get('/getUserSocials/{userId}', [SocialController::class, 'getUserSocials']);
    Route::get('/search/{name}/{userId}', [SocialController::class, 'searchSocials']);
});
Route::prefix('/post')->group(function () {
    Route::post('/create', [PostController::class, 'createPost']);
    Route::get('/public/get/{socialId}/{userId}', [PostController::class, 'getPublicPosts']);
    Route::get('/private/get/{socialId}/{userId}', [PostController::class, 'getPrivatePosts']);
});
Route::prefix('/user')->group(function () {
    Route::prefix('/{userId}')->group(function () {
        Route::get('/get', [UserController::class, 'getUser']);
        Route::get('/getAvatar', [UserController::class, 'getUserAvatar']);
    });
});
Route::match(array('GET', 'POST'),'/ping', function () {
    return 'OK';
});

