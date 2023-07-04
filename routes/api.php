<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Comment\{
    StoreCommentController,
    IndexCommentController,
    ShowCommentController,
};
use App\Http\Controllers\Post\{
    StorePostController,
    IndexPostController,
    ShowPostController,
    UpdatePostController,
    DeletePostController,
};
use App\Http\Controllers\User\{
    StoreUserController,
    IndexUserController,
    ProfileUserController,
    ShowUserController,
    UpdateUserController,
    DeleteUserController,
};
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

// Auth
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', StoreUserController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Users
Route::prefix('users')->middleware('auth:sanctum')->group(function () {
    Route::get('/', IndexUserController::class);
    Route::get('/me', ProfileUserController::class);
    Route::get('/{id}', ShowUserController::class);
    Route::patch('/{id}', UpdateUserController::class);
    Route::delete('/{id}', DeleteUserController::class);
});

// Posts
Route::prefix('posts')->middleware('auth:sanctum')->group(function () {
    Route::post('/', StorePostController::class);
    Route::get('/', IndexPostController::class);
    Route::get('/{id}', ShowPostController::class);
    Route::patch('/{id}', UpdatePostController::class);
    Route::delete('/{id}', DeletePostController::class);
});

// Comments
Route::prefix('comments')->middleware('auth:sanctum')->group(function () {
    Route::post('/', StoreCommentController::class);
    Route::get('/', IndexCommentController::class);
    Route::get('/{id}', ShowCommentController::class);
    // Route::patch('/{id}', UpdateCommentController::class);
    // Route::delete('/{id}', DeleteCommentController::class);
});
