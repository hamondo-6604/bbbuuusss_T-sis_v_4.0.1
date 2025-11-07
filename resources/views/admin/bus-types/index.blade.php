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

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Bus Types</h4>
    <a href="{{ route('admin.bus-types.create') }}" class="btn btn-info">+ Add New Type</a>
  </div>

  @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Type Name</th>
            <th>Seat Layout</th>
            <th>Status</th>
            <th>Description</th>
            <th width="150">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($busTypes as $type)
            <tr>
              <td>{{ $type->id }}</td>
              <td>{{ $type->type_name }}</td>
              <td>{{ $type->seatLayout->layout_name ?? 'N/A' }}</td>
              <td>{{ ucfirst($type->status) }}</td>
              <td>{{ Str::limit($type->description, 40) }}</td>
              <td class="text-center">
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

<!-- 🟦 Edit Modal -->
<div id="editModal" class="modal-overlay">
  <div class="modal-box">
    <div class="modal-header">Edit Bus Type</div>
    <form id="editForm" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group mb-2">
        <label>Type Name</label>
        <input type="text" name="type_name" id="editTypeName" class="form-control" required>
      </div>

      <div class="form-group mb-2">
        <label>Seat Layout</label>
        <select name="seat_layout_id" id="editSeatLayout" class="form-control">
          @foreach($seatLayouts as $layout)
            <option value="{{ $layout->id }}">{{ $layout->layout_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-2">
        <label>Status</label>
        <select name="status" id="editStatus" class="form-control">
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>

      <div class="form-group mb-2">
        <label>Description</label>
        <textarea name="description" id="editDescription" class="form-control" rows="3"></textarea>
      </div>

      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Cancel</button>
        <button type="submit" class="btn btn-info">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- 🟥 Delete Modal -->
<div id="deleteModal" class="modal-overlay">
  <div class="modal-box">
    <div class="modal-header">Confirm Delete</div>
    <p>Are you sure you want to delete <strong id="deleteTypeName"></strong>?</p>
    <form id="deleteForm" method="POST">
      @csrf
      @method('DELETE')
      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </form>
  </div>
</div>

<script>
function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}
function openModal(id) {
  document.getElementById(id).style.display = 'flex';
}

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('editForm');
  const deleteForm = document.getElementById('deleteForm');

  // 🟦 Edit button click
  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('editTypeName').value = btn.dataset.name;
      document.getElementById('editSeatLayout').value = btn.dataset.layout;
      document.getElementById('editStatus').value = btn.dataset.status;
      document.getElementById('editDescription').value = btn.dataset.description;
      editForm.action = `/admin/bus-types/${btn.dataset.id}`;
      openModal('editModal');
    });
  });

  // 🟥 Delete button click
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('deleteTypeName').textContent = btn.dataset.name;
      deleteForm.action = `/admin/bus-types/${btn.dataset.id}`;
      openModal('deleteModal');
    });
  });
});
</script>
@endsection
