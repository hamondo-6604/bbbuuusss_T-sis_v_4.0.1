<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\Bus\BusController;
use App\Http\Controllers\Admin\Bus\BusTypeController;
use App\Http\Controllers\Admin\Bus\SeatLayoutController;
use App\Http\Controllers\Admin\Bus\AmenityController;
use App\Http\Controllers\Admin\Booking\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\Booking\ReportController;
use App\Http\Controllers\Admin\User\UserManagementController;
use App\Http\Controllers\Admin\Trip\RouteController;
use App\Http\Controllers\Admin\Trip\TripController;
use App\Http\Controllers\Admin\Trip\FareController;
use App\Http\Controllers\Admin\Trip\CityController;
use App\Http\Controllers\Admin\Trip\TerminalController;
use App\Http\Controllers\Admin\Trip\RouteStopController;
use App\Http\Controllers\Admin\Trip\ScheduleController;
use App\Http\Controllers\Admin\PaymentController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])
  ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Payments
|--------------------------------------------------------------------------
*/
Route::resource('payments', PaymentController::class)->names([
  'index'   => 'payments.index',
  'create'  => 'payments.create',
  'store'   => 'payments.store',
  'edit'    => 'payments.edit',
  'update'  => 'payments.update',
  'destroy' => 'payments.destroy',
]);

/*
|--------------------------------------------------------------------------
| Bus Management
|--------------------------------------------------------------------------
*/
Route::prefix('buses')->group(function () {
  Route::resource('bus-types', BusTypeController::class)
    ->names([
      'index'   => 'bus-types.index',
      'create'  => 'bus-types.create',
      'store'   => 'bus-types.store',
      'edit'    => 'bus-types.edit',
      'update'  => 'bus-types.update',
      'destroy' => 'bus-types.destroy',
    ]);

  Route::resource('seat-layouts', SeatLayoutController::class)
    ->names([
      'index'   => 'seat-layouts.index',
      'create'  => 'seat-layouts.create',
      'store'   => 'seat-layouts.store',
      'edit'    => 'seat-layouts.edit',
      'update'  => 'seat-layouts.update',
      'destroy' => 'seat-layouts.destroy',
    ]);

  Route::resource('amenities', AmenityController::class)
    ->names([
      'index'   => 'amenities.index',
      'create'  => 'amenities.create',
      'store'   => 'amenities.store',
      'edit'    => 'amenities.edit',
      'update'  => 'amenities.update',
      'destroy' => 'amenities.destroy',
    ]);
});

Route::resource('buses', BusController::class)
  ->names([
    'index'   => 'buses.index',
    'create'  => 'buses.create',
    'store'   => 'buses.store',
    'show'    => 'buses.show',
    'edit'    => 'buses.edit',
    'update'  => 'buses.update',
    'destroy' => 'buses.destroy',
  ]);



/*
|--------------------------------------------------------------------------
| Trip Management
|--------------------------------------------------------------------------
*/
Route::prefix('trip-management')->group(function () {
  Route::resource('cities', CityController::class)->names([
    'index'   => 'cities.index',
    'create'  => 'cities.create',
    'store'   => 'cities.store',
    'edit'    => 'cities.edit',
    'update'  => 'cities.update',
    'destroy' => 'cities.destroy',
  ]);

  Route::resource('terminals', TerminalController::class)->names([
    'index'   => 'terminals.index',
    'create'  => 'terminals.create',
    'store'   => 'terminals.store',
    'edit'    => 'terminals.edit',
    'update'  => 'terminals.update',
    'destroy' => 'terminals.destroy',
  ]);

  Route::resource('routes', RouteController::class)->names([
    'index'   => 'routes.index',
    'create'  => 'routes.create',
    'store'   => 'routes.store',
    'edit'    => 'routes.edit',
    'update'  => 'routes.update',
    'destroy' => 'routes.destroy',
  ]);

  Route::resource('route-stops', RouteStopController::class)->names([
    'index' => 'route-stops.index',
    'create' => 'route-stops.create',
    'store' => 'route-stops.store',
    'edit' => 'route-stops.edit',
    'update' => 'route-stops.update',
    'destroy' => 'route-stops.destroy',
  ]);

  Route::resource('schedules', ScheduleController::class)->names([
    'index'   => 'schedules.index',
    'create'  => 'schedules.create',
    'store'   => 'schedules.store',
    'edit'    => 'schedules.edit',
    'update'  => 'schedules.update',
    'destroy' => 'schedules.destroy',
  ]);

  Route::resource('trips', TripController::class)->names([
    'index'   => 'trips.index',
    'create'  => 'trips.create',
    'store'   => 'trips.store',
    'edit'    => 'trips.edit',
    'update'  => 'trips.update',
    'destroy' => 'trips.destroy',
  ]);

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
| Booking Management
|--------------------------------------------------------------------------
*/
Route::prefix('bookings')->group(function () {
  Route::resource('bookings', AdminBookingController::class)
    ->names([
      'index'   => 'bookings.index',
      'create'  => 'bookings.create',
      'store'   => 'bookings.store',
      'show'    => 'bookings.show',
      'edit'    => 'bookings.edit',
      'update'  => 'bookings.update',
      'destroy' => 'bookings.destroy',
    ]);

  Route::get('status/pending',   [AdminBookingController::class, 'pending'])->name('bookings.status.pending');
  Route::get('status/completed', [AdminBookingController::class, 'completed'])->name('bookings.status.completed');
  Route::get('status/cancelled', [AdminBookingController::class, 'cancelled'])->name('bookings.status.cancelled');

  Route::get('reports', [ReportController::class, 'bookingReports'])->name('bookings.reports');
  Route::get('notifications', [AdminBookingController::class, 'notifications'])->name('bookings.notifications');
});


// Users CRUD
/*
|--------------------------------------------------------------------------
| User Management
|--------------------------------------------------------------------------
*/

// Users & Roles combined
Route::prefix('users')->group(function () {

  // Users CRUD
  Route::resource('users', UserManagementController::class)
    ->except(['show'])
    ->names([
      'index'   => 'users.index',
      'create'  => 'users.create',
      'store'   => 'users.store',
      'edit'    => 'users.edit',
      'update'  => 'users.update',
      'destroy' => 'users.destroy',
    ]);


  // Roles / User Types management inside the same controller
  Route::post('roles', [UserManagementController::class, 'storeRole'])->name('roles.store');
  Route::get('roles/{role}/edit', [UserManagementController::class, 'editRole'])->name('roles.edit');
  Route::put('roles/{role}', [UserManagementController::class, 'updateRole'])->name('roles.update');
  Route::delete('roles/{role}', [UserManagementController::class, 'destroyRole'])->name('roles.destroy');
});
