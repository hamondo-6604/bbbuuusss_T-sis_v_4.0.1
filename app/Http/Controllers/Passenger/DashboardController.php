<?php

namespace App\Http\Controllers\Passenger;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function dashboard(Request $request)
  {
    $user = Auth::user();

    // Passenger dashboard view
    return view('dashboard.passenger_list', [
      'user' => $user
    ]);
  }
}
