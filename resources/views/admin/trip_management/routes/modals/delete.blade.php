<!-- resources/views/admin/trip_management/routes/modals/delete.blade.php -->
@foreach($routes as $route)
  <div class="modal fade" id="deleteRouteModal{{ $route->id }}" tabindex="-1" aria-labelledby="deleteRouteModalLabel{{ $route->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title" id="deleteRouteModalLabel{{ $route->id }}">Delete Route</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete the route from
            <strong>{{ $route->originTerminal->name ?? '-' }}</strong> to
            <strong>{{ $route->destinationTerminal->name ?? '-' }}</strong>?
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
