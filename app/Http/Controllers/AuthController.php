<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Landing page
    public function landing()
    {
        return view('landing.index');
    }

    // Show login form
    public function login()
    {
        return view('auth.login');
    }

    // Show registration form
    public function register()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register_post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create a new customer user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',   // default role
            'status' => 'active',   // default status
        ]);

        return redirect()->route('login')->with('success', 'Registration Successful!');
    }

    // Handle login
    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            $user = Auth::user();

            // Check if user is blocked
            if ($user->status === 'blocked') {
                Auth::logout();
                return redirect()->back()->with('error', 'Your account is blocked.');
            }

            // Redirect based on role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'customer':
                    return redirect()->route('landing');
                case 'driver':
                    return redirect()->route('driver.dashboard'); // future route
                default:
                    Auth::logout();
                    return redirect('/')->with('error', 'Role not recognized.');
            }
        }

        return redirect()->back()->with('error', 'Invalid Credentials.');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
