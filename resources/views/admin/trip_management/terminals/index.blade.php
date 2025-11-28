@extends('layouts.app')

@section('title', 'Trip Management / Terminals')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">

      <!-- HEADER -->
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Trip Management / Terminals</h5>

        <!-- Create Terminal Button -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createTerminalModal">
          <i class="bi bi-plus-circle"></i> Add Terminal
        </button>
      </div>

      <!-- BODY -->
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>City</th>
              <th>Terminal Name</th>
              <th>Code</th>
              <th>Address</th>
              <th>Coordinates</th>
              <th>Contact</th>
              <th>Status</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($terminals as $terminal)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $terminal->city->name ?? 'N/A' }}</td>
                <td>{{ $terminal->name }}</td>
                <td>{{ $terminal->code ?? '-' }}</td>
                <td>{{ $terminal->address ?? '-' }}</td>

                <td>
                  @if($terminal->latitude && $terminal->longitude)
                    <span class="text-primary fw-semibold">
                      {{ $terminal->latitude }}, {{ $terminal->longitude }}
                    </span>
                  @else
                    <span class="text-muted">No coordinates</span>
                  @endif
                </td>

                <td>{{ $terminal->contact_phone ?? '-' }}</td>

                <td>
                  @if($terminal->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>

                <td>
                  <!-- Edit -->
                  <button class="btn btn-warning btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#editTerminalModal{{ $terminal->id }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>

                  <!-- Delete -->
                  <button class="btn btn-danger btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#deleteTerminalModal{{ $terminal->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center text-muted">No terminals found.</td>
              </tr>
            @endforelse
            </tbody>

          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
          {{ $terminals->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- Include Modals -->
  @include('admin.trip_management.terminals.modals.create')
  @include('admin.trip_management.terminals.modals.edit')
  @include('admin.trip_management.terminals.modals.delete')

@endsection
