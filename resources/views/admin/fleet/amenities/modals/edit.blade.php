<!-- Edit Amenity Modals -->
@foreach($amenities as $amenity)
  <div class="modal fade" id="editAmenityModal{{ $amenity->id }}" tabindex="-1" aria-labelledby="editAmenityModalLabel{{ $amenity->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('admin.amenities.update', $amenity->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editAmenityModalLabel{{ $amenity->id }}">Edit Amenity</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="name{{ $amenity->id }}" class="form-label">Amenity Name</label>
              <input type="text" name="name" id="name{{ $amenity->id }}" class="form-control" value="{{ $amenity->name }}" required>
            </div>
            <div class="mb-3">
              <label for="icon{{ $amenity->id }}" class="form-label">Icon (Bootstrap Icon class)</label>
              <input type="text" name="icon" id="icon{{ $amenity->id }}" class="form-control" value="{{ $amenity->icon }}">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
