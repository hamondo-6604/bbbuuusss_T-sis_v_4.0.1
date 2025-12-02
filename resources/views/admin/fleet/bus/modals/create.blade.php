<!-- Create Bus Modal -->
<div class="modal fade" id="createBusModal" tabindex="-1" aria-labelledby="createBusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('admin.buses.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createBusModalLabel">Add New Bus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Bus Number <span class="text-danger">*</span></label>
              <input type="text" name="bus_number" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Bus Name</label>
              <input type="text" name="bus_name" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Bus Type <span class="text-danger">*</span></label>
              <select name="bus_type_id" class="form-select" required>
                <option value="">-- Select Bus Type --</option>
                @foreach($busTypes as $type)
                  <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Seat Layout <span class="text-danger">*</span></label>
              <select name="seat_layout_id" class="form-select" required>
                <option value="">-- Select Layout --</option>
                @foreach($seatLayouts as $layout)
                  <option value="{{ $layout->id }}">{{ $layout->layout_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Capacity <span class="text-danger">*</span></label>
              <input type="number" name="capacity" class="form-control" required min="1">
            </div>
            <div class="col-md-6">
              <label class="form-label">Bus Image</label>
              <input type="file" name="bus_img" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
                <option value="maintenance">Maintenance</option>
              </select>
            </div>
<!-- Amenities -->
<div class="col-12">
  <label class="form-label">Amenities</label>
  <div class="d-flex flex-wrap gap-2">
    @foreach($amenities as $amenity)
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity->id }}" id="amenity{{ $amenity->id }}">
        <label class="form-check-label" for="amenity{{ $amenity->id }}">
          {{ $amenity->name }}
        </label>
      </div>
    @endforeach
  </div>
</div>
<!-- End Amenities -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add Bus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
