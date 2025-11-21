<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\BusRoute;
use App\Models\Bus;

class TripController extends Controller
{
  public function index()
  {
    $trips = Trip::with('route', 'bus')->get();
    return view('admin.triproute_management.trip.index', compact('trips'));
  }

  public function create()
  {
    $routes = BusRoute::all();
    $buses  = Bus::all();
    return view('admin.triproute_management.trip.create', compact('routes', 'buses'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'route_id'       => 'required|exists:routes,id',
      'bus_id'         => 'nullable|exists:buses,id',
      'trip_code'      => 'required|unique:trips,trip_code',
      'trip_date'      => 'required|date',
      'departure_time' => 'required',
      'arrival_time'   => 'nullable',
      'available_seats'=> 'required|integer|min:0',
      'fare'           => 'nullable|numeric|min:0',
    ]);

    Trip::create($request->all());

    return redirect()->route('admin.trips.index')->with('success', 'Trip created successfully.');
  }

  public function edit($id)
  {
    $trip   = Trip::findOrFail($id);
    $routes = BusRoute::all();
    $buses  = Bus::all();
    return view('admin.triproute_management.trip.edit', compact('trip', 'routes', 'buses'));
  }

  public function update(Request $request, $id)
  {
    $trip = Trip::findOrFail($id);

    $request->validate([
      'route_id'       => 'required|exists:routes,id',
      'bus_id'         => 'nullable|exists:buses,id',
      'trip_code'      => 'required|unique:trips,trip_code,' . $trip->id,
      'trip_date'      => 'required|date',
      'departure_time' => 'required',
      'arrival_time'   => 'nullable',
      'available_seats'=> 'required|integer|min:0',
      'fare'           => 'nullable|numeric|min:0',
    ]);

    $trip->update($request->all());

    return redirect()->route('trips.index')->with('success', 'Trip updated successfully.');
  }

  public function destroy($id)
  {
    $trip = Trip::findOrFail($id);
    $trip->delete();

    return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
  }
}
