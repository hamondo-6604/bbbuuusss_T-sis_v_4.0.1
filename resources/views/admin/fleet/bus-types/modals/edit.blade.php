@foreach($busTypes as $busType)
  <div class="modal fade" id="editBusTypeModal{{ $busType->id }}" tabindex="-1" aria-labelledby="editBusTypeModalLabel{{ $busType->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.bus-types.update', $busType->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editBusTypeModalLabel{{ $busType->id }}">Edit Bus Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="mb-3">
              <label for="type_name_{{ $busType->id }}" class="form-label">Type Name</label>
              <input type="text" name="type_name" class="form-control" value="{{ $busType->type_name }}" required>
            </div>

            <div class="mb-3">
              <label for="deck_type_{{ $busType->id }}" class="form-label">Deck Type</label>
              <select name="deck_type" class="form-select" required>
                <option value="single" {{ $busType->deck_type=='single' ? 'selected' : '' }}>Single</option>
                <option value="double" {{ $busType->deck_type=='double' ? 'selected' : '' }}>Double</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="description_{{ $busType->id }}" class="form-label">Description</label>
              <textarea name="description" class="form-control">{{ $busType->description }}</textarea>
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
