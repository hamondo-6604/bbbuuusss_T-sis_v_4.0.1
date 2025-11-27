@extends('layouts.app')

@section('content')

  @include('message')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Fleet / Buses</h2>
      <a href="{{ route('admin.buses.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Bus
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-hover table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Bus Number</th>
            <th>Bus Type</th>
            <th>Seat Layout</th>
            <th>Capacity</th>
            <th>Status</th>
            <th>Amenities</th>
            <th class="text-center">Actions</th>
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
              <td>{{ ucfirst($bus->status) }}</td>
              <td>
                @foreach($bus->amenities as $amenity)
                  <span class="badge bg-info text-dark">{{ $amenity->name }}</span>
                @endforeach
              </td>
              <td class="text-center d-flex justify-content-center gap-2">
                <a href="{{ route('admin.buses.edit', $bus->id) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure to delete this bus?')">
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
              <td colspan="8" class="text-center text-muted">No buses found.</td>
            </tr>
          @endforelse
          </tbody>
        </table>

        <div class="mt-3">
          {{ $buses->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
