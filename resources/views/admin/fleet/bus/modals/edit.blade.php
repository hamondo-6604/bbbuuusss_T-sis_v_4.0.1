<!-- resources/views/admin/modals/edit.bus.blade.php -->
@foreach($buses as $bus)
  <div class="modal fade" id="editBusModal{{ $bus->id }}" tabindex="-1" aria-labelledby="editBusModalLabel{{ $bus->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="modal-header">
            <h5 class="modal-title" id="editBusModalLabel{{ $bus->id }}">Edit Bus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="bus_number_{{ $bus->id }}" class="form-label">Bus Number</label>
                <input type="text" name="bus_number" class="form-control" value="{{ $bus->bus_number }}" required>
              </div>
              <div class="col-md-6">
                <label for="bus_type_id_{{ $bus->id }}" class="form-label">Bus Type</label>
                <select name="bus_type_id" class="form-select" required>
                  @foreach($busTypes as $type)
                    <option value="{{ $type->id }}" {{ $bus->bus_type_id == $type->id ? 'selected' : '' }}>{{ $type->type_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label for="layout_id_{{ $bus->id }}" class="form-label">Seat Layout</label>
                <select name="layout_id" class="form-select" required>
                  @foreach($layouts as $layout)
                    <option value="{{ $layout->id }}" {{ $bus->layout_id == $layout->id ? 'selected' : '' }}>{{ $layout->layout_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label for="capacity_{{ $bus->id }}" class="form-label">Capacity</label>
                <input type="number" name="capacity" class="form-control" value="{{ $bus->capacity }}" required>
              </div>

              <div class="col-md-6">
                <label for="status_{{ $bus->id }}" class="form-label">Status</label>
                <select name="status" class="form-select" required>
                  <option value="active" {{ $bus->status=='active' ? 'selected' : '' }}>Active</option>
                  <option value="inactive" {{ $bus->status=='inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Amenities</label>
                <select name="amenities[]" class="form-select" multiple>
                  @foreach($amenities as $amenity)
                    <option value="{{ $amenity->id }}" {{ in_array($amenity->id, $bus->amenities->pluck('id')->toArray()) ? 'selected' : '' }}>
                      {{ $amenity->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
