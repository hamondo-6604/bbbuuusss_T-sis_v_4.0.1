@extends('layouts.app')

@section('content')
  @include('message')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Cities</h2>
      <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add City
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-hover table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>State</th>
            <th>Country</th>
            <th>Timezone</th>
            <th class="text-center">Actions</th>
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
              <td class="text-center d-flex justify-content-center gap-2">
                <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure to delete this city?')">
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
              <td colspan="6" class="text-center text-muted">No cities found.</td>
            </tr>
          @endforelse
          </tbody>
        </table>

        <div class="mt-3">
          {{ $cities->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
