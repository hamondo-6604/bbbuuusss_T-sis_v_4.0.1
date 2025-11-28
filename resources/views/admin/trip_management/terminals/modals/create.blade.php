<!-- resources/views/admin/trip_management/cities/modals/create.blade.php -->
<div class="modal fade" id="createCityModal" tabindex="-1" aria-labelledby="createCityModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.cities.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createCityModalLabel">Add City</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">City Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" name="state" id="state" class="form-control">
          </div>
          <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" id="country" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="timezone" class="form-label">Timezone</label>
            <input type="text" name="timezone" id="timezone" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save City</button>
        </div>
      </form>
    </div>
  </div>
</div>
