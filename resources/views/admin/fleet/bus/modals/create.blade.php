<!-- resources/views/admin/modals/create.bus.blade.php -->
<div class="modal fade" id="createBusModal" tabindex="-1" aria-labelledby="createBusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.buses.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createBusModalLabel">Add New Bus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="bus_number" class="form-label">Bus Number</label>
              <input type="text" name="bus_number" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="bus_type_id" class="form-label">Bus Type</label>
              <select name="bus_type_id" class="form-select" required>
                <option value="">Select Type</option>
                @foreach($busTypes as $type)
                  <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label for="layout_id" class="form-label">Seat Layout</label>
              <select name="layout_id" class="form-select" required>
                <option value="">Select Layout</option>
                @foreach($layouts as $layout)
                  <option value="{{ $layout->id }}">{{ $layout->layout_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label for="capacity" class="form-label">Capacity</label>
              <input type="number" name="capacity" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label for="status" class="form-label">Status</label>
              <select name="status" class="form-select" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Amenities</label>
              <select name="amenities[]" class="form-select" multiple>
                @foreach($amenities as $amenity)
                  <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Bus</button>
        </div>
      </form>
    </div>
  </div>
</div>
