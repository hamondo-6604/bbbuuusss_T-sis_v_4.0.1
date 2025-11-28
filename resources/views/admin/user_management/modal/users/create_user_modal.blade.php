<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createUserModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="create_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="create_name" name="name" required>
          </div>

          <div class="mb-3">
            <label for="create_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="create_email" name="email" required>
          </div>

          <div class="mb-3">
            <label for="create_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="create_phone" name="phone">
          </div>

          <div class="mb-3">
            <label for="create_user_type" class="form-label">Role</label>
            <select class="form-select" id="create_user_type" name="user_type_id" required>
              @foreach($userTypes as $type)
                <option value="{{ $type->id }}">{{ $type->type_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="create_status" class="form-label">Status</label>
            <select class="form-select" id="create_status" name="status" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
              <option value="banned">Banned</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="create_password" class="form-label">Password</label>
            <input type="password" class="form-control" id="create_password" name="password" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create User</button>
        </div>

      </form>
    </div>
  </div>
</div>
