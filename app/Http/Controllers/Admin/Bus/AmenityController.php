<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
  /**
   * Display a listing of the amenities.
   */
  public function index()
  {
    $amenities = Amenity::orderBy('name')->paginate(10);
    return view('admin.fleet.amenities.index', compact('amenities'));
  }

  /**
   * Show the form for creating a new amenity.
   */
  public function create()
  {
    return view('admin.fleet.amenities.create');
  }

  /**
   * Store a newly created amenity in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|unique:amenities,name',
      'icon' => 'nullable|string'
    ]);

    Amenity::create($request->only(['name', 'icon']));

    return redirect()->route('admin.amenities.index')
      ->with('success', 'Amenity added successfully.');
  }

  /**
   * Show the form for editing the specified amenity.
   */
  public function edit(Amenity $amenity)
  {
    return view('admin.fleet.amenities.edit', compact('amenity'));
  }

  /**
   * Update the specified amenity in storage.
   */
  public function update(Request $request, Amenity $amenity)
  {
    $request->validate([
      'name' => 'required|unique:amenities,name,' . $amenity->id,
      'icon' => 'nullable|string'
    ]);

    $amenity->update($request->only(['name', 'icon']));

    return redirect()->route('admin.amenities.index')
      ->with('success', 'Amenity updated successfully.');
  }

  /**
   * Remove the specified amenity from storage.
   */
  public function destroy(Amenity $amenity)
  {
    $amenity->delete();

    return redirect()->route('admin.amenities.index')
      ->with('success', 'Amenity deleted successfully.');
  }
}
