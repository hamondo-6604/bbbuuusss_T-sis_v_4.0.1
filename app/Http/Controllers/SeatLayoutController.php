<?php

namespace App\Http\Controllers;

use App\Models\SeatLayout;
use Illuminate\Http\Request;

class SeatLayoutController extends Controller
{
    public function index()
    {
        $seatLayouts = SeatLayout::latest()->paginate(10);
        return view('admin.seat_layout.index', compact('seatLayouts'));
    }

    public function create()
    {
        return view('admin.seat_layout.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'layout_name' => 'required|string|max:255',
            'total_rows' => 'required|integer|min:1',
            'total_columns' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        // 🔹 Auto-calculate capacity
        $validated['capacity'] = $request->total_rows * $request->total_columns;

        SeatLayout::create($validated);

        return redirect()->route('admin.seat-layouts.index')
            ->with('success', 'Seat layout created successfully.');
    }

    public function edit($id)
    {
        $seatLayout = SeatLayout::findOrFail($id);
        return view('admin.seat_layout.edit', compact('seatLayout'));
    }

    public function update(Request $request, $id)
    {
        $seatLayout = SeatLayout::findOrFail($id);

        $validated = $request->validate([
            'layout_name' => 'required|string|max:255',
            'total_rows' => 'required|integer|min:1',
            'total_columns' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        // 🔹 Auto-calculate capacity on update
        $validated['capacity'] = $request->total_rows * $request->total_columns;

        $seatLayout->update($validated);

        return redirect()->route('admin.seat-layouts.index')
            ->with('success', 'Seat layout updated successfully.');
    }

    public function destroy($id)
    {
        $seatLayout = SeatLayout::findOrFail($id);
        $seatLayout->delete();

        return redirect()->route('admin.seat-layouts.index')
            ->with('success', 'Seat layout deleted successfully.');
    }
}
