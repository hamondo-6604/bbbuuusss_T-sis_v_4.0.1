<?php

use Illuminate\Support\Facades\Route;

// Public (guest + auth) routes
require __DIR__ . '/public.php';

// Admin routes
Route::middleware(['web', 'admin'])
  ->prefix('admin')
  ->as('admin.')
  ->group(__DIR__ . '/admin.php');

// Passenger/User routes
Route::middleware(['web', 'user'])
  ->prefix('user')
  ->as('user.')
  ->group(__DIR__ . '/user.php');
