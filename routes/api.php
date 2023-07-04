<?php

use App\Http\Controllers\User\{
    StoreUserController,
    IndexUserController,
    ShowUserController,
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

// Users
Route::prefix('users')->group(function () {
    Route::post('/', StoreUserController::class);
    Route::get('/', IndexUserController::class);
    Route::get('/{id}', ShowUserController::class);
});
