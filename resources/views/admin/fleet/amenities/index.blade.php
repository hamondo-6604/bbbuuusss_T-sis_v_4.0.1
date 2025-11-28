@extends('layouts.app')

@section('title', 'Amenities')

@section('content')
  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Amenities</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createAmenityModal">
          <i class="bi bi-plus-circle"></i> Add Amenity
        </button>
      </div>

      <div class="card-body">
        @include('message')

        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Icon</th>
              <th>Name</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($amenities as $amenity)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  @if($amenity->icon)
                    <i class="bi {{ $amenity->icon }}"></i>
                  @else
                    <span class="text-muted">No icon</span>
                  @endif
                </td>
                <td>{{ $amenity->name }}</td>
                <td class="d-flex justify-content-center gap-2">
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAmenityModal{{ $amenity->id }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAmenityModal{{ $amenity->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-muted">No amenities found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          {{ $amenities->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- Include your existing modals -->
  @include('admin.fleet.amenities.modals.create')
  @include('admin.fleet.amenities.modals.edit')
  @include('admin.fleet.amenities.modals.delete')

@endsection
