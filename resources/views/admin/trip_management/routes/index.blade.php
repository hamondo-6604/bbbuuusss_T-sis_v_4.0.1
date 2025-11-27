@extends('layouts.app')

@section('content')
  @include('message')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Routes</h2>
      <a href="{{ route('admin.routes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Route
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-hover table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Origin Terminal</th>
            <th>Destination Terminal</th>
            <th>Via</th>
            <th>Distance (km)</th>
            <th>Duration (min)</th>
            <th>Active</th>
            <th class="text-center">Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($routes as $route)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $route->originTerminal->name }}</td>
              <td>{{ $route->destinationTerminal->name }}</td>
              <td>{{ $route->via ?? '-' }}</td>
              <td>{{ $route->distance_km }}</td>
              <td>{{ $route->duration_min }}</td>
              <td>{{ $route->is_active ? 'Yes' : 'No' }}</td>
              <td class="text-center d-flex justify-content-center gap-2">
                <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure to delete this route?')">
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
              <td colspan="8" class="text-center text-muted">No routes found.</td>
            </tr>
          @endforelse
          </tbody>
        </table>

        <div class="mt-3">
          {{ $routes->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
