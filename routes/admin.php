<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\Bus\BusController;
use App\Http\Controllers\Admin\Bus\BusTypeController;
use App\Http\Controllers\Admin\Bus\SeatLayoutController;
use App\Http\Controllers\Admin\Booking\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\Booking\ReportController;
use App\Http\Controllers\Admin\User\UserManagementController;
use App\Http\Controllers\Admin\Trip\RouteController;
use App\Http\Controllers\Admin\Trip\TripController;
use App\Http\Controllers\Admin\Trip\AssignBusController;
use App\Http\Controllers\Admin\Trip\FareController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])
  ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Bus Management
|--------------------------------------------------------------------------
*/
Route::resource('buses', BusController::class)->names([
  'index'   => 'buses.index',
  'create'  => 'buses.create',
  'store'   => 'buses.store',
  'show'    => 'buses.show',
  'edit'    => 'buses.edit',
  'update'  => 'buses.update',
  'destroy' => 'buses.destroy',
]);

Route::resource('bus-types', BusTypeController::class)->names([
  'index'   => 'bus-types.index',
  'create'  => 'bus-types.create',
  'store'   => 'bus-types.store',
  'edit'    => 'bus-types.edit',
  'update'  => 'bus-types.update',
  'destroy' => 'bus-types.destroy',
]);

Route::resource('seat-layouts', SeatLayoutController::class)->names([
  'index'   => 'seat-layouts.index',
  'create'  => 'seat-layouts.create',
  'store'   => 'seat-layouts.store',
  'edit'    => 'seat-layouts.edit',
  'update'  => 'seat-layouts.update',
  'destroy' => 'seat-layouts.destroy',
]);

/*
|--------------------------------------------------------------------------
| Booking Management
|--------------------------------------------------------------------------
*/
Route::prefix('bookings')->group(function () {

  Route::resource('/', AdminBookingController::class)->names([
    'index'   => 'bookings.index',
    'create'  => 'bookings.create',
    'store'   => 'bookings.store',
    'show'    => 'bookings.show',
    'edit'    => 'bookings.edit',
    'update'  => 'bookings.update',
    'destroy' => 'bookings.destroy',
  ])->parameters(['' => 'booking']);

  Route::get('status/pending',   [AdminBookingController::class, 'pending'])->name('bookings.status.pending');
  Route::get('status/completed', [AdminBookingController::class, 'completed'])->name('bookings.status.completed');
  Route::get('status/cancelled', [AdminBookingController::class, 'cancelled'])->name('bookings.status.cancelled');

  Route::get('reports', [ReportController::class, 'bookingReports'])->name('bookings.reports');
  Route::get('notifications', [AdminBookingController::class, 'notifications'])->name('bookings.notifications');
});

/*
|--------------------------------------------------------------------------
| Trip / Route / Fare Management
|--------------------------------------------------------------------------
*/
Route::prefix('trip-management')->group(function () {

  Route::resource('routes', RouteController::class)->names([
    'index'   => 'routes.index',
    'create'  => 'routes.create',
    'store'   => 'routes.store',
    'edit'    => 'routes.edit',
    'update'  => 'routes.update',
    'destroy' => 'routes.destroy',
  ]);

  Route::resource('trips', TripController::class)->names([
    'index'   => 'trips.index',
    'create'  => 'trips.create',
    'store'   => 'trips.store',
    'edit'    => 'trips.edit',
    'update'  => 'trips.update',
    'destroy' => 'trips.destroy',
  ]);

  Route::get('assign', [AssignBusController::class, 'index'])->name('assign.index');
  Route::post('assign', [AssignBusController::class, 'assign'])->name('assign.store');

  Route::resource('fares', FareController::class)->names([
    'index'   => 'fares.index',
    'create'  => 'fares.create',
    'store'   => 'fares.store',
    'edit'    => 'fares.edit',
    'update'  => 'fares.update',
    'destroy' => 'fares.destroy',
  ]);
});

/*
|--------------------------------------------------------------------------
| User Management
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function () {

  Route::get('roles', [UserManagementController::class, 'roles'])->name('user-roles.index');
  Route::put('roles/{user}', [UserManagementController::class, 'updateRole'])->name('user-roles.update');

  Route::get('activity', [UserManagementController::class, 'activity'])->name('users.activity');
  Route::get('blocked',  [UserManagementController::class, 'blocked'])->name('users.blocked');
  Route::get('bulk',     [UserManagementController::class, 'bulk'])->name('users.bulk');

  Route::resource('/', UserManagementController::class)->except(['show'])->names([
    'index'   => 'users.index',
    'create'  => 'users.create',
    'store'   => 'users.store',
    'edit'    => 'users.edit',
    'update'  => 'users.update',
    'destroy' => 'users.destroy',
  ])->parameters(['' => 'user']);
});
