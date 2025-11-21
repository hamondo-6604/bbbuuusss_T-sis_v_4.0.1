<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusRoute;

class RouteController extends Controller
{
  public function index()
  {
    $routes = BusRoute::all();
    return view('admin.triproute_management.routes.index', compact('routes'));
  }

  public function create()
  {
    return view('admin.triproute_management.routes.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'origin' => 'required|string|max:255',
      'destination' => 'required|string|max:255',
    ]);

    BusRoute::create($request->all());

    return redirect()->route('routes.index')->with('success', 'Route created successfully.');
  }

  public function edit($id)
  {
    $route = BusRoute::findOrFail($id);
    return view('admin.triproute_management.routes.edit', compact('route'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'origin' => 'required|string|max:255',
      'destination' => 'required|string|max:255',
    ]);

    $route = BusRoute::findOrFail($id);
    $route->update($request->all());

    return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
  }

  public function destroy($id)
  {
    $route = BusRoute::findOrFail($id);
    $route->delete();

    return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
  }
}
