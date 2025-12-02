<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Terminal;
use Illuminate\Support\Facades\Log;

class RouteController extends Controller
{
    /**
     * Display a listing of routes.
     */
    public function index()
    {
        $routes = Route::with(['originTerminal', 'destinationTerminal'])->paginate(10);
        $terminals = Terminal::all(); // load terminals
        return view('admin.trip_management.routes.index', compact('routes', 'terminals'));
    }

    /**
     * Show the form for creating a new route.
     */
    public function create()
    {
        $terminals = Terminal::all();
        return view('admin.trip_management.routes.create', compact('terminals'));
    }

    /**
     * Store a newly created route.
     */
    public function store(Request $request)
    {
        // Log incoming request data for debugging purposes
        Log::info('Create Route Request:', $request->all());

        // Validate the incoming request data
        $validated = $request->validate([
            'origin_terminal_id'      => 'required|exists:terminals,id|different:destination_terminal_id',
            'destination_terminal_id' => 'required|exists:terminals,id',
            'via'                     => 'nullable|string|max:255',
            'distance_km'             => 'required|numeric|min:0',
            'duration_min'            => 'required|integer|min:1',
            'is_active'               => 'nullable|boolean',
        ], [
            'origin_terminal_id.required' => 'The origin terminal is required.',
            'destination_terminal_id.required' => 'The destination terminal is required.',
            'distance_km.required' => 'The distance is required.',
            'distance_km.numeric' => 'The distance must be a numeric value.',
            'duration_min.required' => 'The duration is required.',
            'duration_min.integer' => 'The duration must be an integer.',
            'origin_terminal_id.different' => 'The origin terminal must be different from the destination terminal.',
        ]);

        // Log the validated data
        Log::info('Validated Route Data:', $validated);

        // Set the 'is_active' field to true if checkbox is checked, else false
        $validated['is_active'] = $request->has('is_active');

        // Create the route in the database
        try {
            Route::create($validated);
        } catch (\Exception $e) {
            // Log the exception if something goes wrong while saving
            Log::error('Error creating route:', ['error' => $e->getMessage()]);
            return redirect()->route('admin.routes.index')
                ->with('error', 'Failed to create route. Please try again.');
        }

        // Redirect with success message
        return redirect()->route('admin.routes.index')
            ->with('success', 'Route created successfully.');
    }

    /**
     * Show the form for editing a route.
     */
    public function edit(Route $route)
    {
        $terminals = Terminal::all();
        return view('admin.trip_management.routes.edit', compact('route', 'terminals'));
    }

    /**
     * Update a route.
     */
    public function update(Request $request, Route $route)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'origin_terminal_id'      => 'required|exists:terminals,id|different:destination_terminal_id',
            'destination_terminal_id' => 'required|exists:terminals,id',
            'via'                     => 'nullable|string|max:255',
            'distance_km'             => 'required|numeric|min:0',
            'duration_min'            => 'required|integer|min:1',
            'is_active'               => 'nullable|boolean',
        ]);

        // Log validated data
        Log::info('Updating Route Data:', $validated);

        // Set the 'is_active' field to true if checkbox is checked, else false
        $validated['is_active'] = $request->has('is_active');

        // Update the route
        try {
            $route->update($validated);
        } catch (\Exception $e) {
            // Log the error if something goes wrong while updating
            Log::error('Error updating route:', ['error' => $e->getMessage()]);
            return redirect()->route('admin.routes.index')
                ->with('error', 'Failed to update route. Please try again.');
        }

        // Redirect with success message
        return redirect()->route('admin.routes.index')
            ->with('success', 'Route updated successfully.');
    }

    /**
     * Delete a route.
     */
    public function destroy(Route $route)
    {
        try {
            $route->delete();
        } catch (\Exception $e) {
            // Log the error if something goes wrong while deleting
            Log::error('Error deleting route:', ['error' => $e->getMessage()]);
            return redirect()->route('admin.routes.index')
                ->with('error', 'Failed to delete route. Please try again.');
        }

        return redirect()->route('admin.routes.index')
            ->with('success', 'Route deleted successfully.');
    }
}
