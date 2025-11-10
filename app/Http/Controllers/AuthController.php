<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function landing()
    {
        return view('landing.index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

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
            'role' => 'customer',
        ]);

        return redirect()->route('login')->with('success', 'Registration Successful!');
    }

    public function login_post(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($user->role === 'customer') {
                return redirect()->route('landing');
            } else {
                return redirect('/')->with('error', 'No Available Email.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials.');
        }

        // $pass = Hash::make('123456789');
        // dd($pass);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
