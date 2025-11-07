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

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Seat Layouts</h4>
        <a href="{{ route('admin.seat-layouts.create') }}" class="btn btn-info">+ Add New Layout</a>
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
                        <tr>
                            <td>{{ $layout->id }}</td>
                            <td>{{ $layout->layout_name }}</td>
                            <td>{{ $layout->total_rows }}</td>
                            <td>{{ $layout->total_columns }}</td>
                            <td>{{ $layout->capacity }}</td>
                            <td>{{ ucfirst($layout->status) }}</td>
                            <td>{{ Str::limit($layout->description, 40) }}</td>
                            <td class="text-center">
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

<!-- 🟦 Edit Modal -->
<div id="editModal" class="modal-overlay">
  <div class="modal-box">
    <div class="modal-header">Edit Seat Layout</div>
    <form id="editForm" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group mb-2">
        <label>Layout Name</label>
        <input type="text" name="layout_name" id="editLayoutName" class="form-control" required>
      </div>
      <div class="form-group mb-2">
        <label>Rows</label>
        <input type="number" name="total_rows" id="editRows" class="form-control" required>
      </div>
      <div class="form-group mb-2">
        <label>Columns</label>
        <input type="number" name="total_columns" id="editCols" class="form-control" required>
      </div>
      <div class="form-group mb-2">
        <label>Capacity</label>
        <input type="number" id="editCapacity" class="form-control" readonly>
        <small class="text-muted">Auto-calculated (rows × columns)</small>
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
    <p>Are you sure you want to delete <strong id="deleteLayoutName"></strong>?</p>
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

  // Edit button click
  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      document.getElementById('editLayoutName').value = btn.dataset.name;
      document.getElementById('editRows').value = btn.dataset.rows;
      document.getElementById('editCols').value = btn.dataset.cols;
      document.getElementById('editStatus').value = btn.dataset.status;
      document.getElementById('editDescription').value = btn.dataset.description;
      document.getElementById('editCapacity').value = btn.dataset.rows * btn.dataset.cols;

      editForm.action = `/admin/seat-layouts/${id}`;
      openModal('editModal');
    });
  });

  // Delete button click
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      document.getElementById('deleteLayoutName').textContent = btn.dataset.name;
      deleteForm.action = `/admin/seat-layouts/${id}`;
      openModal('deleteModal');
    });
  });

  // Auto-calc capacity on edit
  document.getElementById('editRows').addEventListener('input', calcCap);
  document.getElementById('editCols').addEventListener('input', calcCap);
  function calcCap() {
    const r = parseInt(document.getElementById('editRows').value) || 0;
    const c = parseInt(document.getElementById('editCols').value) || 0;
    document.getElementById('editCapacity').value = r * c;
  }
});
</script>
@endsection
