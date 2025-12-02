<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use App\Models\BusType;
use Illuminate\Http\Request;

class BusTypeController extends Controller
{
  public function index()
  {
    $busTypes = BusType::orderBy('type_name')->paginate(10);
    return view('admin.fleet.bus-types.index', compact('busTypes'));
  }

  public function create()
  {
    return view('admin.fleet.bus-types.modals.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'type_name' => 'required|unique:bus_types,type_name',
      'deck_type' => 'required|in:single,double',
      'description' => 'nullable|string'
    ]);

    BusType::create($request->only(['type_name', 'deck_type', 'description']));

    return redirect()->route('admin.bus-types.index')
      ->with('success', 'Bus type added successfully.');
  }

  public function edit(BusType $busType)
  {
    return view('admin.fleet.bus-types.modals.edit', compact('busType'));
  }

  public function update(Request $request, BusType $busType)
  {
    $request->validate([
      'type_name' => 'required|unique:bus_types,type_name,' . $busType->id,
      'deck_type' => 'required|in:single,double',
      'description' => 'nullable|string'
    ]);

    $busType->update($request->only(['type_name', 'deck_type', 'description']));

    return redirect()->route('admin.bus-types.index')
      ->with('success', 'Bus type updated successfully.');
  }
public function destroy(BusType $busType)
{
    try {
        // Check if any buses are using this bus type
        if ($busType->buses()->count() > 0) {
            return redirect()->route('admin.bus-types.index')
                ->with('error', 'This bus type cannot be deleted because it is used by existing buses.');
        }

        // Safe to delete
        $busType->delete();

        return redirect()->route('admin.bus-types.index')
            ->with('success', 'Bus type deleted successfully.');

    } catch (\Illuminate\Database\QueryException $e) {
        // Catch foreign key constraint error or any DB error
        return redirect()->route('admin.bus-types.index')
            ->with('error', 'Cannot delete this bus type because it is linked to existing buses.');
    } catch (\Exception $e) {
        // Catch any other error
        return redirect()->route('admin.bus-types.index')
            ->with('error', 'Something went wrong. Please try again.');
    }
}

}
