<!-- Create Terminal Modal -->
<div class="modal fade" id="createTerminalModal" tabindex="-1" aria-labelledby="createTerminalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.terminals.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="createTerminalModalLabel">Add New Terminal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">

            <!-- City -->
            <div class="col-md-6">
              <label for="city_id" class="form-label">City <span class="text-danger">*</span></label>
              <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror" required>
                <option value="">Select City</option>
                @foreach($cities as $city)
                  <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                  </option>
                @endforeach
              </select>
              @error('city_id')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Terminal Name -->
            <div class="col-md-6">
              <label for="name" class="form-label">Terminal Name <span class="text-danger">*</span></label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Code -->
            <div class="col-md-6">
              <label for="code" class="form-label">Code</label>
              <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
              @error('code')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Contact Phone -->
            <div class="col-md-6">
              <label for="contact_phone" class="form-label">Contact Phone</label>
              <input type="text" name="contact_phone" id="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror" value="{{ old('contact_phone') }}">
              @error('contact_phone')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Address -->
            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
              @error('address')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Coordinates -->
            <div class="col-md-6">
              <label for="latitude" class="form-label">Latitude</label>
              <input type="text" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}">
              @error('latitude')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="longitude" class="form-label">Longitude</label>
              <input type="text" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}">
              @error('longitude')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Status -->
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Terminal</button>
        </div>
      </form>
    </div>
  </div>
</div>
