<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\{
    StoreCategoryController,
    IndexCategoryController,
};
use App\Http\Controllers\Comment\{
    StoreCommentController,
    IndexCommentController,
    ShowCommentController,
    UpdateCommentController,
    DeleteCommentController,
};
use App\Http\Controllers\Like\{
    StoreLikeController,
    DeleteLikeController,
};
use App\Http\Controllers\Auth\PasswordResetController;
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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

// Auth
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', StoreUserController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Email Verification
Route::prefix('email')->group(function () {
    Route::get('/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth:sanctum')->name('verification.notice');
    Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    })->middleware(['auth:sanctum', 'signed'])->name('verification.verify');
    Route::post('/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    })->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
});

// Password Reset
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPasswordPost'])->middleware('guest')->name('forgot.password.post');

// Users
Route::prefix('users')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', IndexUserController::class);
    Route::get('/me', ProfileUserController::class);
    Route::get('/{id}', ShowUserController::class);
    Route::patch('/{id}', UpdateUserController::class);
    Route::delete('/{id}', DeleteUserController::class);
});

// Posts
// Rotas Públicas
Route::prefix('posts')->group(function () {
    Route::get('/', IndexPostController::class);
    Route::get('/{id}', ShowPostController::class);
});

// Rotas Privadas
Route::prefix('posts')->middleware('auth:sanctum')->group(function () {
    Route::post('/', StorePostController::class);
    Route::patch('/{id}', UpdatePostController::class);
    Route::delete('/{id}', DeletePostController::class);
});

// Comments
// Rotas Públicas
Route::prefix('comments')->group(function () {
    Route::get('/', IndexCommentController::class);
    Route::get('/{id}', ShowCommentController::class);
});

// Rotas Privadas
Route::prefix('comments')->middleware('auth:sanctum')->group(function () {
    Route::post('/', StoreCommentController::class);
    Route::patch('/{id}', UpdateCommentController::class);
    Route::delete('/{id}', DeleteCommentController::class);
});

// Likes
Route::prefix('likes')->middleware('auth:sanctum')->group(function () {
    Route::post('/', StoreLikeController::class);
    Route::delete('/{id}', DeleteLikeController::class);
});

// Categories
Route::prefix('categories')->middleware('auth:sanctum')->group(function () {
    Route::post('/', StoreCategoryController::class);
    Route::get('/', IndexCategoryController::class);
    // Route::get('/{id}', ShowCategoryController::class);
});
