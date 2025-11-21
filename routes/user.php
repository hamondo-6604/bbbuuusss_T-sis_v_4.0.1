<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Passenger\DashboardController;
use App\Http\Controllers\Passenger\BookingController;
use App\Http\Controllers\Passenger\SettingsController;

/*
|--------------------------------------------------------------------------
| Passenger Dashboard
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [DashboardController::class, 'dashboard'])
  ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Passenger Booking Management
|--------------------------------------------------------------------------
*/
Route::prefix('bookings')->group(function () {

  // Bookings list
  Route::get('/', [BookingController::class, 'index'])
    ->name('bookings.index');

  /*
  |--------------------------------------------------------------------------
  | Step 1 — Select Route + Date
  |--------------------------------------------------------------------------
  */
  Route::get('create', [BookingController::class, 'create'])
    ->name('bookings.create');

  Route::post('create', [BookingController::class, 'storeRouteDate'])
    ->name('bookings.storeRouteDate');

  /*
  |--------------------------------------------------------------------------
  | Step 2 — Select Trip
  |--------------------------------------------------------------------------
  */
  Route::get('select-trip/{from}/{to}/{date}', [BookingController::class, 'selectTrip'])
    ->name('bookings.selectTrip');

  /*
  |--------------------------------------------------------------------------
  | Step 3 — Select Seats
  |--------------------------------------------------------------------------
  */
  Route::get('select-seats/{trip}', [BookingController::class, 'selectSeats'])
    ->name('bookings.selectSeats');

  /*
  |--------------------------------------------------------------------------
  | Step 4 — Confirm Booking
  |--------------------------------------------------------------------------
  */
  Route::post('confirm/{trip}', [BookingController::class, 'confirm'])
    ->name('bookings.confirm');

  /*
  |--------------------------------------------------------------------------
  | Final — Complete Booking & Save
  |--------------------------------------------------------------------------
  */
  Route::post('complete/{trip}', [BookingController::class, 'storeFinal'])
    ->name('bookings.storeFinal');
});


/*
|--------------------------------------------------------------------------
| Passenger Settings (Profile / Password)
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function () {

  Route::get('settings', [SettingsController::class, 'index'])
    ->name('settings');

  Route::post('settings/profile', [SettingsController::class, 'updateProfile'])
    ->name('settings.updateProfile');

  Route::post('settings/password', [SettingsController::class, 'updatePassword'])
    ->name('settings.updatePassword');
});
