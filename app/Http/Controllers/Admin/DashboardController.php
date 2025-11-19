<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        $user = Auth::user();

        if($user->role === 'admin'){
            return view('dashboard.admin_list');

        }else if($user->role === 'customer'){
            return view('dashboard.passenger_list');
        }
    }
}
