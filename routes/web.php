<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\ {
    TableAdminController,
    CategoryAdminController,
    ProductAdminController,
    UserAdminController,
};
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{product}', [DashboardController::class, 'show'])->name('dashboard.show');

    Route::resource('tables', TableAdminController::class);
    Route::resource('categories', CategoryAdminController::class);
    Route::resource('products', ProductAdminController::class);
    Route::resource('user', UserAdminController::class);
});
