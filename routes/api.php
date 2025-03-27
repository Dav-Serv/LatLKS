<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ {
    CategoryApiController,
    ProductApiController,
    TableApiController
};
use App\Http\Controllers\Api\Auth\ {
    LoginApiController,
    LogOutApiController,
    RegisterApiController,
};

// Auth
Route::post('user/register', [RegisterApiController::class, 'register'])->name('user.register');
Route::post('user/login', [LoginApiController::class, 'login'])->name('user.login');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Admin
Route::apiResource('/tables', TableApiController::class);
Route::apiResource('/categories', CategoryApiController::class);
Route::apiResource('/products', ProductApiController::class);

// LogOut
Route::middleware('auth:sanctum')->prefix('user')->group(function() {
    Route::post('logout', [LogOutApiController::class, 'logout'])->name('user.logout');
});