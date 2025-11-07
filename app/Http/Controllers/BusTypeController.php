<?php

namespace App\Http\Controllers;

use App\Models\BusType;
use App\Models\SeatLayout;
use Illuminate\Http\Request;

class BusTypeController extends Controller
{
    public function index()
    {
        $busTypes = \App\Models\BusType::with('seatLayout')->latest()->paginate(10);
        $seatLayouts = \App\Models\SeatLayout::all();

        return view('admin.bus-types.index', compact('busTypes', 'seatLayouts'));
    }


    public function create()
{
    // These might be used in your form dropdowns
    $seatLayouts = \App\Models\SeatLayout::where('status', 'active')->get();
    $busTypes = \App\Models\BusType::all(); // 👈 Add this line

    return view('admin.bus-types.create', compact('seatLayouts', 'busTypes'));
}

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:bus_types,type_name',
            'seat_layout_id' => 'nullable|exists:seat_layouts,id',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        BusType::create($request->all());
        return redirect()->route('admin.bus-types.index')->with('success', 'Bus type added successfully!');
    }

    public function edit($id)
    {
        $busType = BusType::findOrFail($id);
        $seatLayouts = SeatLayout::where('status', 'active')->get();
        return view('admin.bus-types.edit', compact('busType', 'seatLayouts'));
    }

    public function update(Request $request, $id)
    {
        $busType = BusType::findOrFail($id);

        $request->validate([
            'type_name' => 'required|unique:bus_types,type_name,' . $busType->id,
            'seat_layout_id' => 'nullable|exists:seat_layouts,id',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        $busType->update($request->all());
        return redirect()->route('admin.bus-types.index')->with('success', 'Bus type updated successfully!');
    }

    public function destroy($id)
    {
        $busType = BusType::findOrFail($id);
        $busType->delete();
        return redirect()->route('admin.bus-types.index')->with('success', 'Bus type deleted successfully!');
    }
}
