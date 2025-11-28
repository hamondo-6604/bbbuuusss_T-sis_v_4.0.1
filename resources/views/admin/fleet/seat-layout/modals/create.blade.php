<!-- resources/views/admin/fleet/seat-layout/modals/create.blade.php -->
<div class="modal fade" id="createLayoutModal" tabindex="-1" aria-labelledby="createLayoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.seat-layouts.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createLayoutModalLabel">Add New Layout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="layout_name" class="form-label">Layout Name</label>
            <input type="text" class="form-control" id="layout_name" name="layout_name" required>
          </div>
          <div class="mb-3">
            <label for="total_seats" class="form-label">Total Seats</label>
            <input type="number" class="form-control" id="total_seats" name="total_seats" required>
          </div>
          <div class="mb-3">
            <label for="deck_type" class="form-label">Deck Type</label>
            <select class="form-select" id="deck_type" name="deck_type" required>
              <option value="single">Single</option>
              <option value="double">Double</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Layout</button>
        </div>
      </form>
    </div>
  </div>
</div>
