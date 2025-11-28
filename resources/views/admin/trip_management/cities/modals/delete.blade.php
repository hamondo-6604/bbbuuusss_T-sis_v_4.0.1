<!-- resources/views/admin/trip_management/cities/modals/delete.blade.php -->
@foreach($cities as $city)
  <div class="modal fade" id="deleteCityModal{{ $city->id }}" tabindex="-1" aria-labelledby="deleteCityModalLabel{{ $city->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title" id="deleteCityModalLabel{{ $city->id }}">Delete City</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete the city <strong>{{ $city->name }}</strong>?
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
