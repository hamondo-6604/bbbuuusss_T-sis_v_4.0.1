@extends('layouts.app')

@section('title', 'Fleet / Buses')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Fleet / Buses</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createBusModal">
          <i class="bi bi-plus-circle"></i> Add Bus
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Bus Number</th>
              <th>Bus Type</th>
              <th>Seat Layout</th>
              <th>Capacity</th>
              <th>Status</th>
              <th>Amenities</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($buses as $bus)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bus->bus_number }}</td>
                <td>{{ $bus->busType->type_name ?? '-' }}</td>
                <td>{{ $bus->layout->layout_name ?? '-' }}</td>
                <td>{{ $bus->capacity }}</td>
                <td>
                  @if($bus->status == 'active')
                    <span class="badge bg-success">Active</span>
                  @elseif($bus->status == 'inactive')
                    <span class="badge bg-danger">Inactive</span>
                  @else
                    <span class="badge bg-warning text-dark">{{ ucfirst($bus->status) }}</span>
                  @endif
                </td>
                <td>
                  @foreach($bus->amenities as $amenity)
                    <span class="badge bg-info text-dark">{{ $amenity->name }}</span>
                  @endforeach
                </td>
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBusModal{{ $bus->id }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBusModal{{ $bus->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-muted text-center">No buses found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
          {{ $buses->links() }}
        </div>
      </div>
    </div>
  </div>

  @if(request()->has('openCreate'))
    <script>
      window.addEventListener('load', function () {
        console.log("openCreate detected");
        var modalElement = document.getElementById('createBusModal');
        var modal = new bootstrap.Modal(modalElement);
        modal.show();
      });
    </script>
  @endif

  <!-- Include Modals -->
  @include('admin.fleet.bus.modals.create')
  @include('admin.fleet.bus.modals.edit')
  @include('admin.fleet.bus.modals.delete')

@endsection


