<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view('.dashboard.passenger_list'); // create a view: resources/views/passenger/dashboard.blade.php
  }
}
