<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::all(); // You can paginate: ->paginate(10)
        return view('admin.user_management.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.user_management.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'role' => 'required|in:admin,driver,customer',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.user_management.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'role' => 'required|string',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Show blocked / inactive users.
     */
    public function blocked()
    {
        $users = User::where('status', 'blocked')->get();
        return view('admin.user_management.users.blocked', compact('users'));
    }

    /**
     * Show user roles and manage permissions.
     */
    public function roles()
    {
        // You can fetch roles from a Role model if you have one
        return view('admin.user_management.roles_permission.roles');
    }

    /**
     * Show user activity logs.
     */
    public function activity()
    {
        // Example: fetch logs from a UserActivity model or log table
        return view('admin.user_management.activity.user_activity');
    }

    /**
     * Show bulk actions / import & export page.
     */
    public function bulk()
    {
        return view('admin.user_management.bulk.bulk_actions');
    }
}
