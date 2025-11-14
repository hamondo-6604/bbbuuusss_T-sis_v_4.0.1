<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {

            if (Auth::user()->role === 'customer') {
                return $next($request);
            }
        }

        // Guest -> redirect to landing page
        return redirect()->route('landing')->with('error', 'Please log in.');
    }
}
