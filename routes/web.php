<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing');
});

Route::get('/katalog', [ProductController::class, 'index'])->name('katalog');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('product.show');

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware([\App\Http\Middleware\AdminAuth::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products/create', [DashboardController::class, 'create'])->name('product.create');
    Route::post('/products', [DashboardController::class, 'store'])->name('product.store');
    Route::get('/products/{id}/edit', [DashboardController::class, 'edit'])->name('product.edit');
    Route::put('/products/{id}', [DashboardController::class, 'update'])->name('product.update');
    Route::delete('/products/{id}', [DashboardController::class, 'destroy'])->name('product.destroy');

    // New route for product listing
    Route::get('/products', [DashboardController::class, 'list'])->name('product.list');
});
