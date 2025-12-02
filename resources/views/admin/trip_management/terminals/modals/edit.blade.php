@foreach($terminals as $terminal)
<div class="modal fade" id="editTerminalModal{{ $terminal->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.terminals.update', $terminal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title fw-bold">Edit Terminal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">

            <!-- City -->
            <div class="col-md-6">
              <label class="form-label">City <span class="text-danger">*</span></label>
              <select name="city_id" class="form-select" required>
                @foreach($cities as $city)
                  <option value="{{ $city->id }}" {{ $terminal->city_id == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Terminal Name -->
            <div class="col-md-6">
              <label class="form-label">Terminal Name <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" value="{{ $terminal->name }}" required>
            </div>

            <!-- Code -->
            <div class="col-md-6">
              <label class="form-label">Code</label>
              <input type="text" name="code" class="form-control" value="{{ $terminal->code }}">
            </div>

            <!-- Contact Phone -->
            <div class="col-md-6">
              <label class="form-label">Contact Phone</label>
              <input type="text" name="contact_phone" class="form-control" value="{{ $terminal->contact_phone }}">
            </div>

            <!-- Address -->
            <div class="col-12">
              <label class="form-label">Address</label>
              <textarea name="address" class="form-control" rows="2">{{ $terminal->address }}</textarea>
            </div>

            <!-- Coordinates -->
            <div class="col-md-6">
              <label class="form-label">Latitude</label>
              <input type="text" name="latitude" class="form-control" value="{{ $terminal->latitude }}">
            </div>

            <div class="col-md-6">
              <label class="form-label">Longitude</label>
              <input type="text" name="longitude" class="form-control" value="{{ $terminal->longitude }}">
            </div>

            <!-- Status -->
            <div class="col-12">
              <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" name="is_active"
                       value="1" {{ $terminal->is_active ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Terminal</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
