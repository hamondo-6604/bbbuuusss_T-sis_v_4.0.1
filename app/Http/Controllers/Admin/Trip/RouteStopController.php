<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RouteStop;
use App\Models\Route;
use App\Models\Stop;

class RouteStopController extends Controller
{
  public function index()
  {
    $routeStops = RouteStop::with(['route.originTerminal', 'route.destinationTerminal', 'stop.city'])
      ->orderBy('route_id')
      ->paginate(10);

    $routes = Route::with(['originTerminal', 'destinationTerminal'])->get();
    $stops = Stop::all();

    return view('admin.trip_management.route_stops.index', compact('routeStops', 'routes', 'stops'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'route_id' => 'required|exists:routes,id',
      'stop_id' => 'required|exists:stops,id',
      'stop_order' => 'required|integer|min:1',
      'distance_from_origin' => 'required|numeric|min:0',
      'estimated_time_min' => 'required|integer|min:0',
      'is_active' => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    RouteStop::create($validated);

    return redirect()->route('admin.route-stops.index')->with('success', 'Route Stop created successfully.');
  }

  public function update(Request $request, RouteStop $route_stop)
  {
    $validated = $request->validate([
      'route_id' => 'required|exists:routes,id',
      'stop_id' => 'required|exists:stops,id',
      'stop_order' => 'required|integer|min:1',
      'distance_from_origin' => 'required|numeric|min:0',
      'estimated_time_min' => 'required|integer|min:0',
      'is_active' => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $route_stop->update($validated);

    return redirect()->route('admin.route-stops.index')->with('success', 'Route Stop updated successfully.');
  }

  public function destroy(RouteStop $route_stop)
  {
    $route_stop->delete();

    return redirect()->route('admin.route-stops.index')->with('success', 'Route Stop deleted successfully.');
  }

}
