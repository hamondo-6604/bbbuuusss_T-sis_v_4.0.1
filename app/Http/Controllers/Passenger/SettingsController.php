<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
  /**
   * Display the user's settings/profile form.
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    $user = Auth::user();
    return view('passenger.settings', compact('user'));
  }

  /**
   * Update the user's profile information.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request)
  {
    $user = Auth::user();

    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        // Ensure email is unique, but ignore the current user's email
        Rule::unique('users')->ignore($user->id),
      ],
      // Add other profile fields if applicable (e.g., phone, address)
    ]);

    $user->fill($validated)->save();

    return redirect()->route('user.settings')
      ->with('success', 'Profile information updated successfully.');
  }
}
