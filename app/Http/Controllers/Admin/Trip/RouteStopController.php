<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RouteStop;
use App\Models\Route;
use App\Models\Stop;

class RouteStopController extends Controller
{
  /**
   * Display a listing of route stops.
   */
  public function index()
  {
    $routeStops = RouteStop::with(['route.originTerminal', 'route.destinationTerminal', 'stop.city'])
      ->orderBy('route_id')
      ->paginate(10);

    return view('admin.trip_management.route_stops.index', compact('routeStops'));
  }

  /**
   * Show the form for creating a new route stop.
   */
  public function create()
  {
    $routes = Route::with(['originTerminal', 'destinationTerminal'])->get();
    $stops  = Stop::with('city')->get();

    return view('admin.trip_management.route_stops.create', compact('routes', 'stops'));
  }

  /**
   * Store a newly created route stop.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'route_id'            => 'required|exists:routes,id',
      'stop_id'             => 'required|exists:stops,id',
      'stop_order'          => 'required|integer|min:1',
      'distance_from_origin'=> 'required|numeric|min:0',
      'estimated_time_min'  => 'required|integer|min:0',
      'is_active'           => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    RouteStop::create($validated);

    return redirect()->route('admin.route-stops.index')
      ->with('success', 'Route Stop created successfully.');
  }

  /**
   * Show the form for editing the specified route stop.
   */
  public function edit(RouteStop $routeStop)
  {
    $routes = Route::with(['originTerminal', 'destinationTerminal'])->get();
    $stops  = Stop::with('city')->get();

    return view('admin.trip_management.route_stops.edit', compact('routeStop', 'routes', 'stops'));
  }

  /**
   * Update the specified route stop.
   */
  public function update(Request $request, RouteStop $routeStop)
  {
    $validated = $request->validate([
      'route_id'            => 'required|exists:routes,id',
      'stop_id'             => 'required|exists:stops,id',
      'stop_order'          => 'required|integer|min:1',
      'distance_from_origin'=> 'required|numeric|min:0',
      'estimated_time_min'  => 'required|integer|min:0',
      'is_active'           => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $routeStop->update($validated);

    return redirect()->route('admin.route-stops.index')
      ->with('success', 'Route Stop updated successfully.');
  }

  /**
   * Remove the specified route stop.
   */
  public function destroy(RouteStop $routeStop)
  {
    $routeStop->delete();

    return redirect()->route('admin.route-stops.index')
      ->with('success', 'Route Stop deleted successfully.');
  }
}
