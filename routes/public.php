<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Landing
Route::get('/', [AuthController::class, 'landing'])->name('landing');

// Guest only pages
Route::middleware('guest')->group(function () {
  Route::get('/login', [AuthController::class, 'login'])->name('login');
  Route::post('/login_post', [AuthController::class, 'login_post'])->name('login_post');

  Route::get('/register', [AuthController::class, 'register'])->name('register');
  Route::post('/register_post', [AuthController::class, 'register_post'])->name('register_post');
});

// Logout (authenticated users)
Route::middleware('auth')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
