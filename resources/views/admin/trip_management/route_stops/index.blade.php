@extends('layouts.app')

@section('title', 'Route Stops')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Route Stops</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createRouteStopModal">
          <i class="bi bi-plus-circle"></i> Add Route Stop
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Route</th>
              <th>Stop</th>
              <th>Order</th>
              <th>Distance from Origin (km)</th>
              <th>Estimated Time (min)</th>
              <th>Status</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($routeStops as $stop)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $stop->route->originTerminal->name ?? '-' }} → {{ $stop->route->destinationTerminal->name ?? '-' }}</td>
                <td>{{ $stop->stop->name ?? '-' }}</td>
                <td>{{ $stop->stop_order }}</td>
                <td>{{ $stop->distance_from_origin }}</td>
                <td>{{ $stop->estimated_time_min }}</td>
                <td>
                  @if($stop->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRouteStopModal{{ $stop->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRouteStopModal{{ $stop->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted">No route stops found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $routeStops->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- Include Modals -->
  @include('admin.trip_management.route_stops.modals.create')
  @include('admin.trip_management.route_stops.modals.edit')
  @include('admin.trip_management.route_stops.modals.delete')

@endsection
