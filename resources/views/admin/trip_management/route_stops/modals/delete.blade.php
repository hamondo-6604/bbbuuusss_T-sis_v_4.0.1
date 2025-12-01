@foreach($routeStops as $routeStop)
  <div class="modal fade" id="deleteRouteStopModal{{ $routeStop->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.route-stops.destroy', $routeStop->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title">Delete Route Stop</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete <strong>{{ $routeStop->stop->name ?? '-' }}</strong> from route <strong>{{ $routeStop->route->originTerminal->name ?? '-' }} → {{ $routeStop->route->destinationTerminal->name ?? '-' }}</strong>?
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
