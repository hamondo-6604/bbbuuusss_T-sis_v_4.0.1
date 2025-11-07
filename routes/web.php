<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusTypeController;
use App\Http\Controllers\SeatLayoutController;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing Page)
|--------------------------------------------------------------------------
*/

// Show the landing page
Route::get('/', function () {
    return view('landing.index');
})->name('landing');

// Login page
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_post', [AuthController::class, 'login_post'])->name('login_post');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Bus Management
    Route::resource('buses', BusController::class, [
        'names' => [
            'index' => 'admin.buses.index',
            'create' => 'admin.buses.create',
            'store' => 'admin.buses.store',
            'show' => 'admin.buses.show',
            'edit' => 'admin.buses.edit',
            'update' => 'admin.buses.update',
            'destroy' => 'admin.buses.destroy',
        ]
    ]);

    // Bus Types Management
    Route::resource('bus-types', BusTypeController::class, [
        'names' => [
            'index' => 'admin.bus-types.index',
            'create' => 'admin.bus-types.create',
            'store' => 'admin.bus-types.store',
            'edit' => 'admin.bus-types.edit',
            'update' => 'admin.bus-types.update',
            'destroy' => 'admin.bus-types.destroy',
        ]
    ]);

    // Seat Layout Management
    Route::resource('seat-layouts', SeatLayoutController::class, [
        'names' => [
            'index' => 'admin.seat-layouts.index',
            'create' => 'admin.seat-layouts.create',
            'store' => 'admin.seat-layouts.store',
            'edit' => 'admin.seat-layouts.edit',
            'update' => 'admin.seat-layouts.update',
            'destroy' => 'admin.seat-layouts.destroy',
        ]
    ]);
});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('user')->group(function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');
});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
