<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::inertia('/', 'Dashboard')->name('dashboard');

    Route::get('/user', [AuthController::class, 'getUser'])->name('user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::inertia('/register', 'Register')->name('register');
    Route::inertia('/login', 'Login')->name('login');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});
