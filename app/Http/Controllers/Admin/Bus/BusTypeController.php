<?php
//
//namespace App\Http\Controllers\Admin\Bus;
//
//use App\Http\Controllers\Controller;
//
//use App\Models\BusType;
//use App\Models\SeatLayout;
//use Illuminate\Http\Request;
//
//class BusTypeController extends Controller
//{
//    public function index()
//    {
//        $busTypes = \App\Models\BusType::with('seatLayout')->latest()->paginate(10);
//        $seatLayouts = \App\Models\SeatLayout::all();
//
//        return view('admin.bus_management.bus-types.index', compact('busTypes', 'seatLayouts'));
//    }
//
//
//    public function create()
//{
//    // These might be used in your form dropdowns
//    $seatLayouts = \App\Models\SeatLayout::where('status', 'active')->get();
//    $busTypes = \App\Models\BusType::all(); // 👈 Add this line
//
//    return view('admin.bus_management.bus-types.create', compact('seatLayouts', 'busTypes'));
//}
//
//    public function store(Request $request)
//    {
//        $request->validate([
//            'type_name' => 'required|unique:bus_types,type_name',
//            'seat_layout_id' => 'nullable|exists:seat_layouts,id',
//            'status' => 'required|in:active,inactive',
//            'description' => 'nullable|string',
//        ]);
//
//        BusType::create($request->all());
//        return redirect()->route('admin.bus-types.index')->with('success', 'Bus type added successfully!');
//    }
//
//    public function edit($id)
//    {
//        $busType = BusType::findOrFail($id);
//        $seatLayouts = SeatLayout::where('status', 'active')->get();
//        return view('admin.bus_management.bus-types.edit', compact('busType', 'seatLayouts'));
//    }
//
//    public function update(Request $request, $id)
//    {
//        $busType = BusType::findOrFail($id);
//
//        $request->validate([
//            'type_name' => 'required|unique:bus_types,type_name,' . $busType->id,
//            'seat_layout_id' => 'nullable|exists:seat_layouts,id',
//            'status' => 'required|in:active,inactive',
//            'description' => 'nullable|string',
//        ]);
//
//        $busType->update($request->all());
//        return redirect()->route('admin.bus-types.index')->with('success', 'Bus type updated successfully!');
//    }
//
//    public function destroy($id)
//    {
//        $busType = BusType::findOrFail($id);
//        $busType->delete();
//        return redirect()->route('admin.bus-types.index')->with('success', 'Bus type deleted successfully!');
//    }
//}


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
    return view('admin.fleet.bus-types.create');
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
    return view('admin.fleet.bus-types.edit', compact('busType'));
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
    // Check if any buses are using this bus type
    if ($busType->buses()->count() > 0) {
      return redirect()->route('admin.bus-types.index')
        ->with('error', 'This bus type cannot be deleted because it is used by existing buses.');
    }

    // Safe to delete
    $busType->delete();

    return redirect()->route('admin.bus-types.index')
      ->with('success', 'Bus type deleted successfully.');
  }
}
