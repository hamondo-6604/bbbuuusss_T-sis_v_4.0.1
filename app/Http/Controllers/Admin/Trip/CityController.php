<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
  /**
   * Display a listing of the cities.
   */
  public function index()
  {
    $cities = City::orderBy('name')->paginate(10);
    return view('admin.trip_management.cities.index', compact('cities'));
  }

  /**
   * Show the form for creating a new city.
   */
  public function create()
  {
    return view('admin.trip_management.cities.create');
  }

  /**
   * Store a newly created city in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name'     => 'required|string|max:255|unique:cities,name',
      'state'    => 'nullable|string|max:255',
      'country'  => 'required|string|max:255',
      'timezone' => 'nullable|string|max:100',
    ]);

    City::create($validated);

    return redirect()->route('admin.cities.index')
      ->with('success', 'City created successfully.');
  }

  /**
   * Show the form for editing the specified city.
   */
  public function edit(City $city)
  {
    return view('admin.trip_management.cities.edit', compact('city'));
  }

  /**
   * Update the specified city in storage.
   */
  public function update(Request $request, City $city)
  {
    $validated = $request->validate([
      'name'     => 'required|string|max:255|unique:cities,name,' . $city->id,
      'state'    => 'nullable|string|max:255',
      'country'  => 'required|string|max:255',
      'timezone' => 'nullable|string|max:100',
    ]);

    $city->update($validated);

    return redirect()->route('admin.cities.index')
      ->with('success', 'City updated successfully.');
  }

  /**
   * Remove the specified city from storage.
   */
  public function destroy(City $city)
  {
    // Check if city is used in stops
    if ($city->stops()->exists()) {
      return redirect()->route('admin.cities.index')
        ->with('error', 'Cannot delete this city because it is used in one or more stops.');
    }

    // Safe to delete
    $city->delete();

    return redirect()->route('admin.cities.index')
      ->with('success', 'City deleted successfully.');
  }
}
