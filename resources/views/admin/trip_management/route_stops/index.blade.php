@extends('layouts.app')

@section('content')
  @include('message')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Route Stops</h2>
      <a href="{{ route('admin.route-stops.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Route Stop
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-hover table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Route</th>
            <th>Stop</th>
            <th>Order</th>
            <th>Distance from Origin (km)</th>
            <th>Estimated Time (min)</th>
            <th>Active</th>
            <th class="text-center">Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($routeStops as $stop)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $stop->route->originTerminal->name }} → {{ $stop->route->destinationTerminal->name }}</td>
              <td>{{ $stop->stop->name }}</td>
              <td>{{ $stop->stop_order }}</td>
              <td>{{ $stop->distance_from_origin }}</td>
              <td>{{ $stop->estimated_time_min }}</td>
              <td>{{ $stop->is_active ? 'Yes' : 'No' }}</td>
              <td class="text-center d-flex justify-content-center gap-2">
                <a href="{{ route('admin.route-stops.edit', $stop->id) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.route-stops.destroy', $stop->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure to delete this route stop?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">No route stops found.</td>
            </tr>
          @endforelse
          </tbody>
        </table>

        <div class="mt-3">
          {{ $routeStops->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
