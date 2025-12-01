@foreach($users as $user)
  <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="modal-header bg-warning">
            <h5 class="modal-title">Edit User: {{ $user->name }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Phone</label>
              <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
            </div>

            <div class="mb-3">
              <label class="form-label">Role</label>
              <select name="user_type_id" class="form-select" required>
                @foreach($userTypes as $type)
                  <option value="{{ $type->id }}"
                    {{ $type->id == $user->user_type_id ? 'selected' : '' }}>
                    {{ $type->type_name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="banned" {{ $user->status == 'banned' ? 'selected' : '' }}>Banned</option>
              </select>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning">Save Changes</button>
          </div>

        </form>

      </div>
    </div>
  </div>
@endforeach
