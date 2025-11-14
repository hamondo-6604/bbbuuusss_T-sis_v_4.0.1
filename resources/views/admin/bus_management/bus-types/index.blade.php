@extends('layouts.app')

@section('content')

<style>
/* 🧩 Modal styling (same style as seat layout page) */
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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Bus Types</h4>
        <a href="{{ route('admin.bus-types.create') }}" class="btn btn-info">+ Add New Type</a>
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
                        <th>Type Name</th>
                        <th>Seat Layout</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($busTypes as $type)
                        <tr class="bus-row">
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->type_name }}</td>
                            <td>{{ $type->seatLayout->layout_name ?? 'N/A' }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $type->status == 'active' ? 'success' : ($type->status == 'inactive' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($type->status) }}
                                </span>
                            </td>
                            <td>{{ Str::limit($type->description, 40) }}</td>
                            <td class="position-relative">
                                <div class="actions-overlay">
                                    <button class="btn btn-info edit-btn"
                                        data-id="{{ $type->id }}"
                                        data-name="{{ $type->type_name }}"
                                        data-status="{{ $type->status }}"
                                        data-layout="{{ $type->seat_layout_id }}"
                                        data-description="{{ $type->description }}">
                                        Edit
                                    </button>

                                    <button class="btn btn-danger delete-btn"
                                        data-id="{{ $type->id }}"
                                        data-name="{{ $type->type_name }}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No bus types found.</td>
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

<!-- Include Modals -->
@include('admin.bus_management.bus-types.partials.edit-modal')
@include('admin.bus_management.bus-types.partials.delete-modal')

@push('scripts')
<script type="module" src="{{ Vite::asset('resources/js/pages/bus-types.js') }}"></script>
@endpush
@endsection
