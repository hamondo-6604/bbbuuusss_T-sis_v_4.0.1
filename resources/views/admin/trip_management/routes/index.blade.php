@extends('layouts.app')

@section('title', 'Routes')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Routes</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createRouteModal">
          <i class="bi bi-plus-circle"></i> Add Route
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Origin</th>
              <th>Destination</th>
              <th>Via</th>
              <th>Distance (km)</th>
              <th>Duration (min)</th>
              <th>Status</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($routes as $route)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $route->originTerminal->name ?? '-' }} ({{ $route->originTerminal->city->name ?? '-' }})</td>
                <td>{{ $route->destinationTerminal->name ?? '-' }} ({{ $route->destinationTerminal->city->name ?? '-' }})</td>
                <td>{{ $route->via ?? '-' }}</td>
                <td>{{ $route->distance_km }}</td>
                <td>{{ $route->duration_min }}</td>
                <td>
                  @if($route->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRouteModal{{ $route->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRouteModal{{ $route->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted">No routes found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $routes->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- Include Modals -->
  @include('admin.trip_management.routes.modals.create')
  @include('admin.trip_management.routes.modals.edit')
  @include('admin.trip_management.routes.modals.delete')

@endsection
