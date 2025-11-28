@extends('layouts.app')

@section('title', 'Bus Types')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Bus Types</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createBusTypeModal">
          <i class="bi bi-plus-circle"></i> Add Bus Type
        </button>
      </div>

      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Type Name</th>
              <th>Deck Type</th>
              <th>Description</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($busTypes as $busType)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $busType->type_name }}</td>
                <td>{{ ucfirst($busType->deck_type) }}</td>
                <td>{{ $busType->description ?? '-' }}</td>
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBusTypeModal{{ $busType->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBusTypeModal{{ $busType->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-muted">No bus types found</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $busTypes->links() }}
        </div>

      </div>
    </div>

  </div>

  {{-- Include Modals --}}
  @include('admin.fleet.bus-types.modals.create')
  @include('admin.fleet.bus-types.modals.edit')
  @include('admin.fleet.bus-types.modals.delete')

@endsection
