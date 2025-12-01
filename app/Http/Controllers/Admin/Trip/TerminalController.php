<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Terminal;
use App\Models\City;

class TerminalController extends Controller
{
  /**
   * Display a listing of terminals.
   */
  public function index()
  {
    $terminals = Terminal::with('city')->paginate(10);
    $cities = City::orderBy('name')->paginate(10); // <-- paginate here
    return view('admin.trip_management.terminals.index', compact('terminals', 'cities'));
  }

  /**
   * Show the form for creating a new terminal.
   */
  public function create()
  {
    $cities = City::orderBy('name')->get();
    return view('admin.trip_management.terminals.modals.create', compact('cities'));
  }

  /**
   * Store a newly created terminal in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'city_id'        => 'required|exists:cities,id',
      'name'           => 'required|string|max:255|unique:terminals,name,NULL,id,city_id,' . $request->city_id,
      'code'           => 'nullable|string|max:50',
      'address'        => 'nullable|string|max:255',
      'latitude'       => 'nullable|numeric',
      'longitude'      => 'nullable|numeric',
      'contact_phone'  => 'nullable|string|max:50',
      'is_active'      => 'nullable|boolean',
    ], [
      // <-- custom error message
      'name.unique' => 'Terminal already exists in this city.',
    ]);

    $validated['is_active'] = $request->has('is_active');

    Terminal::create($validated);

    return redirect()->route('admin.terminals.index')
      ->with('success', 'Terminal created successfully.');
  }

  /**
   * Show the form for editing an existing terminal.
   */
  public function edit(Terminal $terminal)
  {
    $cities = City::orderBy('name')->get();
    return view('admin.trip_management.terminals.modals.edit', compact('terminal', 'cities'));
  }

  /**
   * Update the terminal.
   */
  public function update(Request $request, Terminal $terminal)
  {
    $validated = $request->validate([
      'city_id'        => 'required|exists:cities,id',
      'name'           => 'required|string|max:255|unique:terminals,name,' . $terminal->id . ',id,city_id,' . $request->city_id,
      'code'           => 'nullable|string|max:50',
      'address'        => 'nullable|string|max:255',
      'latitude'       => 'nullable|numeric',
      'longitude'      => 'nullable|numeric',
      'contact_phone'  => 'nullable|string|max:50',
      'is_active'      => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $terminal->update($validated);

    return redirect()->route('admin.terminals.index')
      ->with('success', 'Terminal updated successfully.');
  }


  /**
   * Delete terminal.
   */
  public function destroy(Terminal $terminal)
  {
    $terminal->delete();

    return redirect()->route('admin.terminals.index')
      ->with('success', 'Terminal deleted successfully.');
  }
}
