@extends('layouts.app')

@section('content')

<style>
/* 🧩 Basic modal styling */
.modal-overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal-box {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  width: 450px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
}

.modal-header {
  font-weight: 600;
  margin-bottom: 10px;
}

.modal-actions {
  margin-top: 20px;
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.btn {
  padding: 6px 12px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-info { background: #0d6efd; color: white; }
.btn-danger { background: #dc3545; color: white; }
.btn-secondary { background: #6c757d; color: white; }
</style>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Seat Layouts</h4>
        <a href="{{ route('admin.seat-layouts.create') }}" class="btn btn-info">+ Add New Layout</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Layout Name</th>
                        <th>Rows</th>
                        <th>Columns</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($seatLayouts as $layout)
                        <tr class="bus-row">
                            <td>{{ $layout->id }}</td>
                            <td>{{ $layout->layout_name }}</td>
                            <td>{{ $layout->total_rows }}</td>
                            <td>{{ $layout->total_columns }}</td>
                            <td>{{ $layout->capacity }}</td>
                            <td>
                                <span class="badge bg-{{ $layout->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($layout->status) }}
                                </span>
                            </td>
                            <td>{{ Str::limit($layout->description, 40) }}</td>
                            <td class="position-relative">
                                <div class="actions-overlay">
                                    <button class="btn btn-info edit-btn"
                                        data-id="{{ $layout->id }}"
                                        data-name="{{ $layout->layout_name }}"
                                        data-rows="{{ $layout->total_rows }}"
                                        data-cols="{{ $layout->total_columns }}"
                                        data-status="{{ $layout->status }}"
                                        data-description="{{ $layout->description }}">
                                        Edit
                                    </button>

                                    <button class="btn btn-danger delete-btn"
                                        data-id="{{ $layout->id }}"
                                        data-name="{{ $layout->layout_name }}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No seat layouts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $seatLayouts->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Include Modals -->
@include('admin.bus_management.seat_layout.partials.edit-modal')
@include('admin.bus_management.seat_layout.partials.delete-modal')

@push('scripts')
<script type="module" src="{{ Vite::asset('resources/js/pages/seat-layouts.js') }}"></script>
@endpush
@endsection
