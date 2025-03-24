<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ {
    CategoryApiController,
    ProductApiController,
    TableApiController
};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/tables', TableApiController::class);
Route::apiResource('/categories', CategoryApiController::class);
Route::apiResource('/products', ProductApiController::class);