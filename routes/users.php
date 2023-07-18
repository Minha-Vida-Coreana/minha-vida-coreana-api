<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\{
    IndexUserController,
    ProfileUserController,
    ShowUserController,
    UpdateUserController,
    DeleteUserController,
};

Route::prefix('users')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', IndexUserController::class);
    Route::get('/me', ProfileUserController::class);
    Route::get('/{id}', ShowUserController::class);
    Route::patch('/{id}', UpdateUserController::class);
    Route::delete('/{id}', DeleteUserController::class);
});
