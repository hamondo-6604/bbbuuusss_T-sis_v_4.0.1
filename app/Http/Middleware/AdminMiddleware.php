<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {

            if (Auth::user()->role === 'admin') {
                return $next($request);
            // } else {
            //     return redirect()->route('landing')->with('error','Access denied');
             }
        }

        // Guest -> redirect to landing page
        return redirect()->route('landing')->with('error','Please login to access this page.');
    }
}
