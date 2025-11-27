<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    if (!Auth::check()) {
      return redirect()->route('landing')->with('error', 'Please log in.');
    }

    if (Auth::user()->userType && Auth::user()->userType->type_name === 'driver') {
      return $next($request);
    }

    // Logged-in but not a driver
    return redirect()->route('landing')->with('error', 'Access denied.');
  }
}
