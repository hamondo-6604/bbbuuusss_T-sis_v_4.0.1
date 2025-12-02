<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\SeatLayout;
use App\Models\Amenity;
use Illuminate\Http\Request;

class BusController extends Controller
{
    // Display list of buses
    public function index()
    {
        $buses = Bus::with(['busType', 'layout', 'amenities'])
            ->orderBy('bus_number')
            ->paginate(10);

        $busTypes = BusType::all();
        $seatLayouts = SeatLayout::all();
        $amenities = Amenity::all();

        return view('admin.fleet.bus.index', compact('buses', 'busTypes', 'seatLayouts', 'amenities'));
    }

    // Return create modal (optional if you load as separate view)
    public function create()
    {
        $busTypes = BusType::orderBy('type_name')->get();
        $seatLayouts = SeatLayout::orderBy('layout_name')->get();
        $amenities = Amenity::orderBy('name')->get();

        return view('admin.fleet.bus.modals.create', compact('busTypes', 'seatLayouts', 'amenities'));
    }

    // Store new bus
    public function store(Request $request)
    {
        $request->validate([
            'bus_number' => 'required|unique:buses,bus_number',
            'bus_name' => 'nullable|string|max:255',
            'bus_type_id' => 'required|exists:bus_types,id',
            'seat_layout_id' => 'required|exists:seat_layouts,id',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive,maintenance',
            'description' => 'nullable|string',
            'bus_img' => 'nullable|image|max:2048',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        $data = $request->only([
            'bus_number', 'bus_name', 'bus_type_id', 'seat_layout_id',
            'capacity', 'status', 'description'
        ]);

        // Handle bus image upload
        if ($request->hasFile('bus_img')) {
            $data['bus_img'] = $request->file('bus_img')->store('buses', 'public');
        }

        $bus = Bus::create($data);

        // Attach amenities if any
        if ($request->has('amenities')) {
            $bus->amenities()->sync($request->amenities);
        }

        return redirect()->route('admin.buses.index')->with('success', 'Bus added successfully.');
    }

    // Return edit modal
    public function edit(Bus $bus)
    {
        $busTypes = BusType::orderBy('type_name')->get();
        $seatLayouts = SeatLayout::orderBy('layout_name')->get();
        $amenities = Amenity::orderBy('name')->get();

        $bus->load('amenities');

        return view('admin.fleet.bus.modals.edit', compact('bus', 'busTypes', 'seatLayouts', 'amenities'));
    }

    // Update bus
    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'bus_number' => 'required|unique:buses,bus_number,' . $bus->id,
            'bus_name' => 'nullable|string|max:255',
            'bus_type_id' => 'required|exists:bus_types,id',
            'seat_layout_id' => 'required|exists:seat_layouts,id',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive,maintenance',
            'description' => 'nullable|string',
            'bus_img' => 'nullable|image|max:2048',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        $data = $request->only([
            'bus_number', 'bus_name', 'bus_type_id', 'seat_layout_id',
            'capacity', 'status', 'description'
        ]);

        // Handle bus image upload
        if ($request->hasFile('bus_img')) {
            $data['bus_img'] = $request->file('bus_img')->store('buses', 'public');
        }

        $bus->update($data);

        // Sync amenities
        if ($request->has('amenities')) {
            $bus->amenities()->sync($request->amenities);
        } else {
            $bus->amenities()->sync([]); // remove all if none selected
        }

        return redirect()->route('admin.buses.index')->with('success', 'Bus updated successfully.');
    }

    // Delete bus
    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('admin.buses.index')->with('success', 'Bus deleted successfully.');
    }
}
