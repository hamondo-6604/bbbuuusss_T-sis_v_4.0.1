<!-- resources/views/admin/fleet/seat-layout/modals/edit.blade.php -->
@foreach($layouts as $layout)
  <div class="modal fade" id="editLayoutModal{{ $layout->id }}" tabindex="-1" aria-labelledby="editLayoutModalLabel{{ $layout->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.seat-layouts.update', $layout->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editLayoutModalLabel{{ $layout->id }}">Edit Layout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="layout_name_{{ $layout->id }}" class="form-label">Layout Name</label>
              <input type="text" class="form-control" id="layout_name_{{ $layout->id }}" name="layout_name" value="{{ $layout->layout_name }}" required>
            </div>
            <div class="mb-3">
              <label for="total_seats_{{ $layout->id }}" class="form-label">Total Seats</label>
              <input type="number" class="form-control" id="total_seats_{{ $layout->id }}" name="total_seats" value="{{ $layout->total_seats }}" required>
            </div>
            <div class="mb-3">
              <label for="deck_type_{{ $layout->id }}" class="form-label">Deck Type</label>
              <select class="form-select" id="deck_type_{{ $layout->id }}" name="deck_type" required>
                <option value="single" {{ $layout->deck_type == 'single' ? 'selected' : '' }}>Single</option>
                <option value="double" {{ $layout->deck_type == 'double' ? 'selected' : '' }}>Double</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="description_{{ $layout->id }}" class="form-label">Description</label>
              <textarea class="form-control" id="description_{{ $layout->id }}" name="description">{{ $layout->description }}</textarea>
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
