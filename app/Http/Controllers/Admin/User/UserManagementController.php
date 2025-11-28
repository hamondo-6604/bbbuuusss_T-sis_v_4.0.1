<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
  /**
   * Display a listing of users and roles.
   */
  public function index(Request $request)
  {
    $search = $request->search;

    $users = User::with('userType')
      ->when($search, fn($query) => $query
        ->where('name', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%")
        ->orWhere('phone', 'like', "%{$search}%"))
      ->latest()
      ->paginate(10);

    $userTypes = UserType::all();

    return view('admin.user_management.index', compact('users', 'userTypes'));
  }

  /**
   * Store a new user.
   */
  public function store(Request $request)
  {
    $request->validate([
      'user_type_id' => 'required|exists:user_types,id',
      'name'         => 'required|string|max:255',
      'email'        => 'required|email|unique:users,email',
      'phone'        => 'nullable|string|max:15|unique:users,phone',
      'password'     => 'required|min:6',
      'status'       => 'required|in:active,inactive,banned',
    ]);

    User::create([
      'user_type_id' => $request->user_type_id,
      'name'         => $request->name,
      'email'        => $request->email,
      'phone'        => $request->phone,
      'password'     => Hash::make($request->password),
      'status'       => $request->status,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
  }

  /**
   * Update an existing user.
   */
  public function update(Request $request, $id)
  {
    $user = User::findOrFail($id);

    $request->validate([
      'user_type_id' => 'required|exists:user_types,id',
      'name'         => 'required|string|max:255',
      'email'        => "required|email|unique:users,email,{$id},id",
      'phone'        => "nullable|string|max:15|unique:users,phone,{$id},id",
      'password'     => 'nullable|min:6',
      'status'       => 'required|in:active,inactive,banned',
    ]);

    $user->update([
      'user_type_id' => $request->user_type_id,
      'name'         => $request->name,
      'email'        => $request->email,
      'phone'        => $request->phone,
      'status'       => $request->status,
    ]);

    if ($request->filled('password')) {
      $user->update(['password' => Hash::make($request->password)]);
    }

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
  }

  /**
   * Delete a user.
   */
  public function destroy($id)
  {
    User::findOrFail($id)->delete();
    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
  }

  /**
   * Store a new role.
   */
  public function storeRole(Request $request)
  {
    $request->validate([
      'type_name'  => 'required|string|max:255|unique:user_types,type_name',
      'description'=> 'nullable|string|max:500',
      'is_default' => 'nullable|boolean',
    ]);

    $role = UserType::create([
      'type_name'  => $request->type_name,
      'description'=> $request->description,
      'is_default' => $request->has('is_default'),
    ]);

    if ($role->is_default) {
      UserType::where('id', '!=', $role->id)->update(['is_default' => false]);
    }

    return redirect()->route('admin.users.index')->with('success', 'Role created successfully.');
  }

  /**
   * Show a role for editing (modal).
   */
  public function editRole($id)
  {
    $role = UserType::findOrFail($id);
    return view('admin.user_management.modal.roles.edit_role_modal', compact('role'));
  }

  /**
   * Update a role.
   */
  public function updateRole(Request $request, $id)
  {
    $role = UserType::findOrFail($id);

    $request->validate([
      'type_name'  => "required|string|max:255|unique:user_types,type_name,{$id}",
      'description'=> 'nullable|string|max:500',
      'is_default' => 'nullable|boolean',
    ]);

    $role->update([
      'type_name'  => $request->type_name,
      'description'=> $request->description,
      'is_default' => $request->has('is_default'),
    ]);

    if ($role->is_default) {
      UserType::where('id', '!=', $role->id)->update(['is_default' => false]);
    }

    return redirect()->route('admin.users.index')->with('success', 'Role updated successfully.');
  }

  /**
   * Delete a role.
   */
  public function destroyRole($id)
  {
    UserType::findOrFail($id)->delete();
    return redirect()->route('admin.users.index')->with('success', 'Role deleted successfully.');
  }
}
