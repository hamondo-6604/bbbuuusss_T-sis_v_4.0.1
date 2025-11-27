<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    if (!Auth::check()) {
      return redirect()->route('landing')->with('error', 'Please login to access this page.');
    }

    if (Auth::user()->userType && Auth::user()->userType->type_name === 'admin') {
      return $next($request);
    }

    // Logged-in but not admin
    return redirect()->route('landing')->with('error', 'Access denied.');
  }
}
