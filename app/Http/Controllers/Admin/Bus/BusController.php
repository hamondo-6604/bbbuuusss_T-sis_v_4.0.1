<?php
//
//namespace App\Http\Controllers\Admin\Bus;
//
//use App\Http\Controllers\Controller;
//
//use App\Models\Bus;
//use App\Models\BusType;
//use App\Models\SeatLayout;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
//
//class BusController extends Controller
//{
//    public function index()
//    {
//        $buses = Bus::with(['type', 'seatLayout'])->orderBy('id', 'desc')->get();
//        return view('admin.bus_management.bus.index', compact('buses'));
//    }
//
//    public function create()
//    {
//        // Load all bus types together with their seat layout
//        $busTypes = \App\Models\BusType::with('seatLayout')->get();
//
//        return view('admin.bus_management.bus.create', compact('busTypes'));
//    }
//
//    public function store(Request $request)
//    {
//        $request->validate([
//            'bus_number' => 'required|unique:buses,bus_number',
//            'bus_name' => 'required',
//            'bus_type_id' => 'required|exists:bus_types,id',
//            'seat_layout_id' => 'required|exists:seat_layouts,id',
//            'total_seats' => 'required|integer|min:1',
//            'bus_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
//            'status' => 'required|in:active,inactive,maintenance',
//        ]);
//
//        $imagePath = null;
//        if ($request->hasFile('bus_img')) {
//            $imagePath = $request->file('bus_img')->store('buses', 'public');
//        }
//
//        Bus::create([
//            'bus_number' => $request->bus_number,
//            'bus_name' => $request->bus_name,
//            'bus_type_id' => $request->bus_type_id,
//            'seat_layout_id' => $request->seat_layout_id,
//            'total_seats' => $request->total_seats,
//            'bus_img' => $imagePath,
//            'status' => $request->status,
//            'description' => $request->description,
//        ]);
//
//        return redirect()->route('admin.buses.index')->with('success', 'Bus added successfully!');
//    }
//
//    public function edit($id)
//    {
//        $bus = Bus::findOrFail($id);
//        $busTypes = BusType::where('status', 'active')->get();
//        $seatLayouts = SeatLayout::where('status', 'active')->get();
//        return view('admin.bus_management.bus.edit', compact('bus', 'busTypes', 'seatLayouts'));
//    }
//
//    public function update(Request $request, $id)
//    {
//        $bus = Bus::findOrFail($id);
//
//        $request->validate([
//            'bus_number' => 'required|unique:buses,bus_number,' . $bus->id,
//            'bus_name' => 'required',
//            'bus_type_id' => 'required|exists:bus_types,id',
//            'seat_layout_id' => 'required|exists:seat_layouts,id',
//            'total_seats' => 'required|integer|min:1',
//            'bus_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
//            'status' => 'required|in:active,inactive,maintenance',
//        ]);
//
//        $imagePath = $bus->bus_img;
//        if ($request->hasFile('bus_img')) {
//            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
//                Storage::disk('public')->delete($imagePath);
//            }
//            $imagePath = $request->file('bus_img')->store('buses', 'public');
//        }
//
//        $bus->update([
//            'bus_number' => $request->bus_number,
//            'bus_name' => $request->bus_name,
//            'bus_type_id' => $request->bus_type_id,
//            'seat_layout_id' => $request->seat_layout_id,
//            'total_seats' => $request->total_seats,
//            'bus_img' => $imagePath,
//            'status' => $request->status,
//            'description' => $request->description,
//        ]);
//
//        return redirect()->route('admin.buses.index')->with('success', 'Bus updated successfully!');
//    }
//
//    public function show($id)
//    {
//        $bus = Bus::with(['type', 'seatLayout'])->findOrFail($id);
//        return view('admin.bus_management.bus.show', compact('bus'));
//    }
//
//    public function destroy($id)
//    {
//        $bus = Bus::findOrFail($id);
//        if ($bus->bus_img && Storage::disk('public')->exists($bus->bus_img)) {
//            Storage::disk('public')->delete($bus->bus_img);
//        }
//        $bus->delete();
//        return redirect()->route('admin.buses.index')->with('success', 'Bus deleted successfully!');
//    }
//}


namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\SeatLayout;
use App\Models\Amenity;
use Illuminate\Http\Request;

class BusController extends Controller
{
  public function index()
  {
    $buses = Bus::with(['busType', 'layout', 'amenities'])
      ->orderBy('bus_number')
      ->paginate(10);

    $busTypes = BusType::all();
    $layouts = SeatLayout::all();
    $amenities = Amenity::all(); // <- fetch amenities for the modal

    return view('admin.fleet.bus.index', compact('buses', 'busTypes', 'layouts', 'amenities'));
  }


  public function create()
  {
    // Fetch all bus types, seat layouts, and amenities
    $busTypes = BusType::orderBy('type_name')->get();
    $layouts = SeatLayout::orderBy('layout_name')->get();  // renamed from $seatLayouts to $layouts
    $amenities = Amenity::orderBy('name')->get();

    // Pass them to the modal view
    return view('admin.fleet.bus.modals.create', compact('busTypes', 'layouts', 'amenities'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'bus_number' => 'required|unique:buses,bus_number',
      'bus_type_id' => 'required|exists:bus_types,id',
      'seat_layout_id' => 'required|exists:seat_layouts,id',
      'capacity' => 'required|integer|min:1',
      'status' => 'required|in:active,inactive,maintenance',
      'amenities' => 'array',
      'amenities.*' => 'exists:amenities,id',
    ]);

    $bus = Bus::create($request->only(['bus_number', 'bus_type_id', 'seat_layout_id', 'capacity', 'status']));

    if ($request->has('amenities')) {
      $bus->amenities()->sync($request->amenities);
    }

    return redirect()->route('admin.buses.index')->with('success', 'Bus added successfully.');
  }

  public function edit(Bus $bus)
  {
    $busTypes = BusType::orderBy('type_name')->get();
    $seatLayouts = SeatLayout::orderBy('layout_name')->get();
    $amenities = Amenity::orderBy('name')->get();

    $bus->load('amenities');

    return view('admin.fleet.bus.modals.edit', compact('bus', 'busTypes', 'seatLayouts', 'amenities'));
  }

  public function update(Request $request, Bus $bus)
  {
    $request->validate([
      'bus_number' => 'required|unique:buses,bus_number,' . $bus->id,
      'bus_type_id' => 'required|exists:bus_types,id',
      'seat_layout_id' => 'required|exists:seat_layouts,id',
      'capacity' => 'required|integer|min:1',
      'status' => 'required|in:active,inactive,maintenance',
      'amenities' => 'array',
      'amenities.*' => 'exists:amenities,id',
    ]);

    $bus->update($request->only(['bus_number', 'bus_type_id', 'layout_id', 'capacity', 'status']));

    if ($request->has('amenities')) {
      $bus->amenities()->sync($request->amenities);
    } else {
      $bus->amenities()->sync([]);
    }

    return redirect()->route('admin.buses.index')->with('success', 'Bus updated successfully.');
  }

  public function destroy(Bus $bus)
  {
    $bus->delete();
    return redirect()->route('admin.buses.index')->with('success', 'Bus deleted successfully.');
  }
}
