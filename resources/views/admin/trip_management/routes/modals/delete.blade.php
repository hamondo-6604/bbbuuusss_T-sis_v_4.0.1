<!-- Delete Route Modal -->
@foreach($routes as $route)
    <div class="modal fade" id="deleteRouteModal{{ $route->id }}" tabindex="-1" aria-labelledby="deleteRouteModalLabel{{ $route->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRouteModalLabel{{ $route->id }}">Delete Route</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the route from <strong>{{ $route->originTerminal->name }}</strong> to <strong>{{ $route->destinationTerminal->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
