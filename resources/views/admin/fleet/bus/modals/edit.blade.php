<!-- Edit Bus Modal -->
@foreach($buses as $bus)
<div class="modal fade" id="editBusModal{{ $bus->id }}" tabindex="-1" aria-labelledby="editBusModalLabel{{ $bus->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBusModalLabel{{ $bus->id }}">Edit Bus: {{ $bus->bus_number }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Bus Number <span class="text-danger">*</span></label>
              <input type="text" name="bus_number" class="form-control" value="{{ $bus->bus_number }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Bus Name</label>
              <input type="text" name="bus_name" class="form-control" value="{{ $bus->bus_name }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Bus Type <span class="text-danger">*</span></label>
              <select name="bus_type_id" class="form-select" required>
                <option value="">-- Select Bus Type --</option>
                @foreach($busTypes as $type)
                  <option value="{{ $type->id }}" {{ $bus->bus_type_id == $type->id ? 'selected' : '' }}>{{ $type->type_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Seat Layout <span class="text-danger">*</span></label>
              <select name="seat_layout_id" class="form-select" required>
                <option value="">-- Select Layout --</option>
                @foreach($seatLayouts as $layout)
                  <option value="{{ $layout->id }}" {{ $bus->seat_layout_id == $layout->id ? 'selected' : '' }}>{{ $layout->layout_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Capacity <span class="text-danger">*</span></label>
              <input type="number" name="capacity" class="form-control" value="{{ $bus->capacity }}" required min="1">
            </div>
            <div class="col-md-6">
              <label class="form-label">Bus Image</label>
              <input type="file" name="bus_img" class="form-control" accept="image/*">
              @if($bus->bus_img)
                <img src="{{ asset($bus->bus_img) }}" alt="Bus Image" class="img-thumbnail mt-2" style="height:80px;">
              @endif
            </div>
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="active" {{ $bus->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $bus->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="maintenance" {{ $bus->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update Bus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach
