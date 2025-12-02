<!-- Edit Route Modal -->
@foreach($routes as $route)
    <div class="modal fade" id="editRouteModal{{ $route->id }}" tabindex="-1" aria-labelledby="editRouteModalLabel{{ $route->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRouteModalLabel{{ $route->id }}">Edit Route</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.routes.update', $route->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="origin_terminal_id" class="form-label">Origin Terminal</label>
                            <select id="origin_terminal_id" name="origin_terminal_id" class="form-select" required>
                                @foreach($terminals as $terminal)
                                    <option value="{{ $terminal->id }}" {{ $route->origin_terminal_id == $terminal->id ? 'selected' : '' }}>
                                        {{ $terminal->name }} ({{ $terminal->city->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="destination_terminal_id" class="form-label">Destination Terminal</label>
                            <select id="destination_terminal_id" name="destination_terminal_id" class="form-select" required>
                                @foreach($terminals as $terminal)
                                    <option value="{{ $terminal->id }}" {{ $route->destination_terminal_id == $terminal->id ? 'selected' : '' }}>
                                        {{ $terminal->name }} ({{ $terminal->city->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="via" class="form-label">Via</label>
                            <input type="text" id="via" name="via" class="form-control" value="{{ $route->via }}" />
                        </div>

                        <div class="mb-3">
                            <label for="distance_km" class="form-label">Distance (km)</label>
                            <input type="number" id="distance_km" name="distance_km" class="form-control" step="0.01" value="{{ $route->distance_km }}" required />
                        </div>

                        <div class="mb-3">
                            <label for="duration_min" class="form-label">Duration (min)</label>
                            <input type="number" id="duration_min" name="duration_min" class="form-control" value="{{ $route->duration_min }}" required />
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $route->is_active ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Update Route</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
