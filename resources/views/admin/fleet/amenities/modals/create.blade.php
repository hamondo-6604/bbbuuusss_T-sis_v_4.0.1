<!-- Create Amenity Modal -->
<div class="modal fade" id="createAmenityModal" tabindex="-1" aria-labelledby="createAmenityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.amenities.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="createAmenityModalLabel">Create Amenity</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <!-- Amenity Name -->
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Amenity Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Enter amenity name" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Icon Field -->
          <div class="mb-3">
            <label for="icon" class="form-label fw-semibold">Icon (Ionicons name)</label>
            <input type="text" name="icon" id="icon"
                   class="form-control @error('icon') is-invalid @enderror"
                   value="{{ old('icon') }}"
                   placeholder="e.g. wifi-outline, water-outline">
            <small class="text-muted">
              Optional. Find icons at <a href="https://ionic.io/ionicons" target="_blank">Ionicons Library</a>
            </small>
            @error('icon')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Amenity</button>
        </div>
      </form>
    </div>
  </div>
</div>
