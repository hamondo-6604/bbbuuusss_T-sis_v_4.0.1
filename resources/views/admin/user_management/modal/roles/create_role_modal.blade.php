<div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" class="form-control" name="type_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Default Role</label>
            <select class="form-select" name="is_default" required>
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Role</button>
        </div>
      </form>
    </div>
  </div>
</div>
