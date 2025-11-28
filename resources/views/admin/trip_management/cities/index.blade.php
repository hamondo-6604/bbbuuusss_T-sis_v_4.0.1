@extends('layouts.app')

@section('title', 'Cities')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Cities</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCityModal">
          <i class="bi bi-plus-circle"></i> Add City
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>State</th>
              <th>Country</th>
              <th>Timezone</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cities as $city)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $city->name }}</td>
                <td>{{ $city->state ?? '-' }}</td>
                <td>{{ $city->country }}</td>
                <td>{{ $city->timezone ?? '-' }}</td>
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editCityModal{{ $city->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCityModal{{ $city->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-muted">No cities found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $cities->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- Include Modals -->
  @include('admin.trip_management.cities.modals.create')
  @include('admin.trip_management.cities.modals.edit')
  @include('admin.trip_management.cities.modals.delete')

@endsection
