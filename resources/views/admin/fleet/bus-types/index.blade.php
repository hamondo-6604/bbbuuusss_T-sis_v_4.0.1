@extends('layouts.app')

@section('content')
@include('message')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Bus Types</h2>
      <a href="{{ route('admin.bus-types.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Bus Type
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Type Name</th>
            <th>Deck Type</th>
            <th>Description</th>
            <th class="text-center">Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($busTypes as $busType)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $busType->type_name }}</td>
              <td>{{ ucfirst($busType->deck_type) }}</td>
              <td>{{ $busType->description ?? '-' }}</td>
              <td class="text-center d-flex justify-content-center gap-2">
                <a href="{{ route('admin.bus-types.edit', $busType->id) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i>
                </a>

                <form action="{{ route('admin.bus-types.destroy', $busType->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure to delete this bus type?')">
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
              <td colspan="5" class="text-center text-muted">No bus types found.</td>
            </tr>
          @endforelse
          </tbody>
        </table>

        <div class="mt-3">
          {{ $busTypes->links() }}
        </div>
      </div>
    </div>
  </div>

@endsection
