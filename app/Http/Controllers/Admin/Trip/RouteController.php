<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Terminal;

class RouteController extends Controller
{
  /**
   * Display a listing of routes.
   */
  public function index()
  {
    $routes = Route::with(['originTerminal', 'destinationTerminal'])->paginate(10);
    $terminals = Terminal::all(); // load terminals
    return view('admin.trip_management.routes.index', compact('routes', 'terminals'));
  }

  /**
   * Show the form for creating a new route.
   */
  public function create()
  {
    $terminals = Terminal::all();
    return view('admin.trip_management.routes.create', compact('terminals'));
  }

  /**
   * Store a newly created route.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'origin_terminal_id'      => 'required|exists:terminals,id|different:destination_terminal_id',
      'destination_terminal_id' => 'required|exists:terminals,id',
      'via'                     => 'nullable|string|max:255',
      'distance_km'             => 'required|numeric|min:0',
      'duration_min'            => 'required|integer|min:1',
      'is_active'               => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    Route::create($validated);

    return redirect()->route('admin.routes.index')
      ->with('success', 'Route created successfully.');
  }

  /**
   * Show the form for editing a route.
   */
  public function edit(Route $route)
  {
    $terminals = Terminal::all();
    return view('admin.trip_management.routes.edit', compact('route', 'terminals'));
  }

  /**
   * Update a route.
   */
  public function update(Request $request, Route $route)
  {
    $validated = $request->validate([
      'origin_terminal_id'      => 'required|exists:terminals,id|different:destination_terminal_id',
      'destination_terminal_id' => 'required|exists:terminals,id',
      'via'                     => 'nullable|string|max:255',
      'distance_km'             => 'required|numeric|min:0',
      'duration_min'            => 'required|integer|min:1',
      'is_active'               => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $route->update($validated);

    return redirect()->route('admin.routes.index')
      ->with('success', 'Route updated successfully.');
  }

  /**
   * Delete a route.
   */
  public function destroy(Route $route)
  {
    $route->delete();

    return redirect()->route('admin.routes.index')
      ->with('success', 'Route deleted successfully.');
  }
}
