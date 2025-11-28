@extends('layouts.app')

@section('title', 'Fleet / Seat Layouts')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Fleet / Seat Layouts</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createLayoutModal">
          <i class="bi bi-plus-circle"></i> Add Layout
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Layout Name</th>
              <th>Total Seats</th>
              <th>Deck Type</th>
              <th>Description</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($layouts as $layout)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $layout->layout_name }}</td>
                <td>{{ $layout->total_seats }}</td>
                <td>{{ ucfirst($layout->deck_type) }}</td>
                <td>{{ $layout->description ?? '-' }}</td>
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editLayoutModal{{ $layout->id }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteLayoutModal{{ $layout->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted">No seat layouts found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
          {{ $layouts->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- Include Modals -->
  @include('admin.fleet.seat-layout.modals.create')
  @include('admin.fleet.seat-layout.modals.edit')
  @include('admin.fleet.seat-layout.modals.delete')

@endsection
