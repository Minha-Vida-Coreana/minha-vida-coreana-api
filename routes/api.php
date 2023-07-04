<?php

use App\Http\Controllers\User\IndexUserController;
use App\Http\Controllers\User\StoreUserController;
use App\Http\Controllers\User\UserController;
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

// Users
Route::prefix('users')->group(function () {
    Route::post('/', StoreUserController::class);
    Route::get('/', IndexUserController::class);
});
