<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Passenger\DashboardController as UserDashboardController;
use App\Http\Controllers\Passenger\BookingController as UserBookingController;
use App\Http\Controllers\Passenger\SettingsController;

/*
|--------------------------------------------------------------------------
| User (Passenger) Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])
  ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Passenger Bookings
|--------------------------------------------------------------------------
*/
Route::resource('bookings', UserBookingController::class);

/*
|--------------------------------------------------------------------------
| Passenger Settings
|--------------------------------------------------------------------------
*/
Route::get('/settings', [SettingsController::class, 'index'])
  ->name('settings');
