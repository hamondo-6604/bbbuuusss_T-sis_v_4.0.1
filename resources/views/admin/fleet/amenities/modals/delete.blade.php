<!-- Delete Amenity Modals -->
@foreach($amenities as $amenity)
  <div class="modal fade" id="deleteAmenityModal{{ $amenity->id }}" tabindex="-1" aria-labelledby="deleteAmenityModalLabel{{ $amenity->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.amenities.destroy', $amenity->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title" id="deleteAmenityModalLabel{{ $amenity->id }}">Delete Amenity</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete the amenity <strong>{{ $amenity->name }}</strong>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
