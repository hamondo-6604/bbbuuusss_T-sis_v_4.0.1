<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use App\Models\SeatLayout;
use Illuminate\Http\Request;

class SeatLayoutController extends Controller
{
  public function index()
  {
    $layouts = SeatLayout::orderBy('layout_name')->paginate(10);
    return view('admin.fleet.seat-layout.index', compact('layouts'));
  }

  public function create()
  {
    return view('admin.fleet.seat-layout.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'layout_name' => 'required|unique:seat_layouts,layout_name',
      'total_seats' => 'required|integer|min:1',
      'deck_type' => 'required|in:single,double',
      'description' => 'nullable|string'
    ]);

    SeatLayout::create($request->only(['layout_name', 'total_seats', 'deck_type', 'description']));

    return redirect()->route('admin.seat-layouts.index')
      ->with('success', 'Seat layout added successfully.');
  }

  public function edit(SeatLayout $seatLayout)
  {
    return view('admin.fleet.seat-layout.edit', compact('seatLayout'));
  }

  public function update(Request $request, SeatLayout $seatLayout)
  {
    $request->validate([
      'layout_name' => 'required|unique:seat_layouts,layout_name,' . $seatLayout->id,
      'total_seats' => 'required|integer|min:1',
      'deck_type' => 'required|in:single,double',
      'description' => 'nullable|string'
    ]);

    $seatLayout->update($request->only(['layout_name', 'total_seats', 'deck_type', 'description']));

    return redirect()->route('admin.seat-layouts.index')
      ->with('success', 'Seat layout updated successfully.');
  }

  public function destroy(SeatLayout $seatLayout)
  {
    // Check if any bus is still using this layout
    if ($seatLayout->buses()->exists()) {
      return redirect()->route('admin.seat-layouts.index')
        ->with('error', 'This seat layout cannot be deleted because it is currently assigned to one or more buses.');
    }

    // Safe to delete
    $seatLayout->delete();

    return redirect()->route('admin.seat-layouts.index')
      ->with('success', 'Seat layout deleted successfully.');
  }
}
