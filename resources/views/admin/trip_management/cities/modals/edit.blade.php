<!-- resources/views/admin/trip_management/cities/modals/edit.blade.php -->
@foreach($cities as $city)
  <div class="modal fade" id="editCityModal{{ $city->id }}" tabindex="-1" aria-labelledby="editCityModalLabel{{ $city->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editCityModalLabel{{ $city->id }}">Edit City</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="name{{ $city->id }}" class="form-label">City Name</label>
              <input type="text" name="name" id="name{{ $city->id }}" class="form-control" value="{{ $city->name }}" required>
            </div>
            <div class="mb-3">
              <label for="state{{ $city->id }}" class="form-label">State</label>
              <input type="text" name="state" id="state{{ $city->id }}" class="form-control" value="{{ $city->state }}">
            </div>
            <div class="mb-3">
              <label for="country{{ $city->id }}" class="form-label">Country</label>
              <input type="text" name="country" id="country{{ $city->id }}" class="form-control" value="{{ $city->country }}" required>
            </div>
            <div class="mb-3">
              <label for="timezone{{ $city->id }}" class="form-label">Timezone</label>
              <input type="text" name="timezone" id="timezone{{ $city->id }}" class="form-control" value="{{ $city->timezone }}">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update City</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
