<?php


namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Import the models
use App\Models\Bus;
use App\Models\Route;
use App\Models\Terminal;
use App\Models\Schedule;

class ScheduleController extends Controller
{
  /**
   * Display all schedules
   */
  public function index()
  {
    $schedules = Schedule::with(['bus', 'route.originTerminal', 'route.destinationTerminal'])
      ->latest()
      ->paginate(10);

    $buses = Bus::where('status', 'active')->get();
    $routes = Route::where('is_active', true)->with(['originTerminal', 'destinationTerminal'])->get();
    $terminals = Terminal::all();

    return view('admin.schedules.index', compact('schedules', 'buses', 'routes', 'terminals'));
  }

  /**
   * Show create form
   */
  public function create()
  {
    $buses = Bus::where('status', 'active')->get();
    $routes = Route::where('is_active', true)->get();
    $terminals = Terminal::all();

    return view('admin.schedules.create', compact('buses', 'routes', 'terminals'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'bus_id' => 'required|exists:buses,id',
      'route_id' => 'required|exists:routes,id',
      'departure_terminal_id' => 'required|exists:terminals,id',
      'arrival_terminal_id' => 'required|exists:terminals,id',
      'departure_time' => 'required|date',
      'arrival_time' => 'required|date|after:departure_time',
      'status' => 'required|in:active,cancelled,completed',
    ]);

    Schedule::create([
      'id' => (string) Str::uuid(),
      'bus_id' => $request->bus_id,
      'route_id' => $request->route_id,
      'departure_terminal_id' => $request->departure_terminal_id,
      'arrival_terminal_id' => $request->arrival_terminal_id,
      'departure_time' => $request->departure_time,
      'arrival_time' => $request->arrival_time,
      'status' => $request->status,
    ]);

    return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
  }

  /**
   * Show edit page
   */
  public function edit(Schedule $schedule)
  {
    $buses = Bus::where('status', 'active')->get();
    $routes = Route::where('is_active', true)
      ->with(['originTerminal', 'destinationTerminal'])
      ->get();

    return view('admin.schedules.edit', compact('schedule', 'buses', 'routes'));
  }

  /**
   * Update schedule
   */
  public function update(Request $request, Schedule $schedule)
  {
    $validated = $request->validate([
      'bus_id' => 'required|exists:buses,id',
      'route_id' => 'required|exists:routes,id',
      'departure_time' => 'required|date|after:now',
      'arrival_time' => 'required|date|after:departure_time',
      'status' => 'required|in:active,cancelled,completed',
    ]);

    $route = Route::findOrFail($request->route_id);

    $departure = str_replace('T', ' ', $request->departure_time);
    $arrival = str_replace('T', ' ', $request->arrival_time);

    $schedule->update([
      'bus_id' => $request->bus_id,
      'route_id' => $request->route_id,
      'departure_terminal_id' => $route->origin_terminal_id,
      'arrival_terminal_id' => $route->destination_terminal_id,
      'departure_time' => $departure,
      'arrival_time' => $arrival,
      'status' => $request->status,
    ]);

    return redirect()->route('admin.schedules.index')
      ->with('success', 'Schedule updated successfully!');
  }

  /**
   * Delete a schedule
   */
  public function destroy(Schedule $schedule)
  {
    $schedule->delete();

    return redirect()->route('admin.schedules.index')
      ->with('success', 'Schedule deleted successfully!');
  }
}
