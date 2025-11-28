<div class="modal fade" id="createBusTypeModal" tabindex="-1" aria-labelledby="createBusTypeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.bus-types.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createBusTypeModalLabel">Add Bus Type</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="type_name" class="form-label">Type Name</label>
            <input type="text" name="type_name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="deck_type" class="form-label">Deck Type</label>
            <select name="deck_type" class="form-select" required>
              <option value="single">Single</option>
              <option value="double">Double</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Bus Type</button>
        </div>
      </form>
    </div>
  </div>
</div>
