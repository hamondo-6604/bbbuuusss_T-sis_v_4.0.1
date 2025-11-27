@extends('layouts.app')

@section('content')

  @include('message')

  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Seat Layouts</h2>
      <a href="{{ route('admin.seat-layouts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Layout
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Layout Name</th>
            <th>Total Seats</th>
            <th>Deck Type</th>
            <th>Description</th>
            <th class="text-center">Actions</th>
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
              <td class="text-center d-flex justify-content-center gap-2">
                <a href="{{ route('admin.seat-layouts.edit', $layout->id) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i>
                </a>

                <form action="{{ route('admin.seat-layouts.destroy', $layout->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure to delete this layout?')">
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
              <td colspan="6" class="text-center text-muted">No seat layouts found.</td>
            </tr>
          @endforelse
          </tbody>
        </table>

        <div class="mt-3">
          {{ $layouts->links() }}
        </div>
      </div>
    </div>
  </div>

@endsection
