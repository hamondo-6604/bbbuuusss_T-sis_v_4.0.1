<div class="modal fade" id="editRoleModal-{{ $type->id ?? '' }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('admin.roles.update', $type->id ?? '') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" class="form-control" name="type_name" value="{{ $type->type_name ?? '' }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Default Role</label>
            <select class="form-select" name="is_default" required>
              <option value="0" {{ ($type->is_default ?? 0) == 0 ? 'selected' : '' }}>No</option>
              <option value="1" {{ ($type->is_default ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Update Role</button>
        </div>
      </form>
    </div>
  </div>
</div>
