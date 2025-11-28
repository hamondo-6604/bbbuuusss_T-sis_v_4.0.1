@extends('layouts.app')

@section('title', 'Schedules')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Schedules</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createScheduleModal">
          <i class="bi bi-plus-circle"></i> Add Schedule
        </button>
      </div>

      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Route</th>
              <th>Bus</th>
              <th>Departure</th>
              <th>Arrival</th>
              <th>Status</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($schedules as $schedule)
              <tr>
                <td>{{ $loop->iteration }}</td>

                {{-- Route --}}
                <td>
                  {{ $schedule->route->originTerminal->name ?? 'N/A' }}
                  @if($schedule->route->via)
                    → {{ $schedule->route->via }}
                  @endif
                  → {{ $schedule->route->destinationTerminal->name ?? 'N/A' }}
                </td>

                {{-- Bus --}}
                <td>{{ $schedule->bus->bus_number ?? 'N/A' }}</td>

                {{-- Departure --}}
                <td>{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d M Y - h:i A') }}</td>

                {{-- Arrival --}}
                <td>{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('d M Y - h:i A') }}</td>

                {{-- Status --}}
                <td>
                  @switch($schedule->status)
                    @case('active')
                      <span class="badge bg-success">Active</span>
                      @break
                    @case('cancelled')
                      <span class="badge bg-danger">Cancelled</span>
                      @break
                    @case('completed')
                      <span class="badge bg-secondary">Completed</span>
                      @break
                    @default
                      <span class="badge bg-warning">Unknown</span>
                  @endswitch
                </td>

                {{-- Actions --}}
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editScheduleModal{{ $schedule->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteScheduleModal{{ $schedule->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-muted">No schedules found</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $schedules->links() }}
        </div>

      </div>
    </div>

  </div>

  {{-- Include Modals --}}
  @include('admin.schedules.modals.create')
  @include('admin.schedules.modals.edit')
  @include('admin.schedules.modals.delete')

@endsection
