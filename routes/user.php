<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Passenger\DashboardController as UserDashboardController;
use App\Http\Controllers\Passenger\BookingController as UserBookingController;
//use App\Http\Controllers\Passenger\SearchController;
use App\Http\Controllers\Passenger\SettingsController;

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [UserDashboardController::class, 'index'])
  ->name('dashboard');

/*
|--------------------------------------------------------------------------
| My Bookings
|--------------------------------------------------------------------------
*/
Route::prefix('bookings')->group(function () {
  Route::get('/', [UserBookingController::class, 'index'])->name('bookings.index'); // List all bookings
  Route::get('{booking}', [UserBookingController::class, 'show'])->name('bookings.show'); // Booking details
  Route::post('{booking}/cancel', [UserBookingController::class, 'cancel'])->name('bookings.cancel'); // Cancel booking
});

/*
|--------------------------------------------------------------------------
| Search Trips
|--------------------------------------------------------------------------
*/
//Route::get('search', [SearchController::class, 'index'])->name('search');

/*
|--------------------------------------------------------------------------
| Account Settings
|--------------------------------------------------------------------------
*/
Route::get('settings', [SettingsController::class, 'index'])->name('settings');
Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
