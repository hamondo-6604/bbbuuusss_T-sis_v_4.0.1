<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use App\Models\SeatLayout;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SeatLayoutController extends Controller
{
    public function index()
    {
        $seatLayouts = SeatLayout::latest()->paginate(10);
        return view('admin.bus_management.seat_layout.index', compact('seatLayouts'));
    }

    public function create()
    {
        return view('admin.bus_management.seat_layout.create');
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

        // 🔸 Check for existing record before inserting
        $exists = SeatLayout::where('layout_name', $validated['layout_name'])
            ->where('total_rows', $validated['total_rows'])
            ->where('total_columns', $validated['total_columns'])
            ->exists();

        if ($exists) {
            return redirect()
                ->route('admin.seat-layouts.index')
                ->with('warning', 'A seat layout with the same name and size already exists.');
        }

        try {
            SeatLayout::create($validated);

            return redirect()
                ->route('admin.seat-layouts.index')
                ->with('success', 'Seat layout created successfully.');
        } catch (QueryException $e) {
            // Handle duplicate key error gracefully (in case of race conditions)
            if ($e->errorInfo[1] === 1062) { // MySQL duplicate entry error code
                return redirect()
                    ->route('admin.seat-layouts.index')
                    ->with('warning', 'Duplicate entry detected. The seat layout already exists.');
            }

            // Handle any other DB error
            return redirect()
                ->route('admin.seat-layouts.index')
                ->with('error', 'An unexpected error occurred while saving the seat layout.');
        }
    }

    public function edit($id)
    {
        $seatLayout = SeatLayout::findOrFail($id);
        return view('admin.bus_management.seat_layout.edit', compact('seatLayout'));
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

        // 🔹 Auto-calculate capacity
        $validated['capacity'] = $request->total_rows * $request->total_columns;

        // 🔸 Prevent updating to a duplicate layout
        $duplicate = SeatLayout::where('layout_name', $validated['layout_name'])
            ->where('total_rows', $validated['total_rows'])
            ->where('total_columns', $validated['total_columns'])
            ->where('id', '!=', $id)
            ->exists();

        if ($duplicate) {
            return redirect()
                ->route('admin.seat-layouts.index')
                ->with('warning', 'Another seat layout with the same details already exists.');
        }

        try {
            $seatLayout->update($validated);

            return redirect()
                ->route('admin.seat-layouts.index')
                ->with('success', 'Seat layout updated successfully.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return redirect()
                    ->route('admin.seat-layouts.index')
                    ->with('warning', 'Duplicate entry detected while updating.');
            }

            return redirect()
                ->route('admin.seat-layouts.index')
                ->with('error', 'An unexpected error occurred while updating the seat layout.');
        }
    }

    public function destroy($id)
    {
        $seatLayout = SeatLayout::findOrFail($id);
        $seatLayout->delete();

        return redirect()
            ->route('admin.seat-layouts.index')
            ->with('success', 'Seat layout deleted successfully.');
    }
}
