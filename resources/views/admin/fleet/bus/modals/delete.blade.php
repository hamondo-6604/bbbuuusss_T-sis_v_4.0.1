<!-- resources/views/admin/modals/delete.bus.blade.php -->
@foreach($buses as $bus)
  <div class="modal fade" id="deleteBusModal{{ $bus->id }}" tabindex="-1" aria-labelledby="deleteBusModalLabel{{ $bus->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST">
          @csrf
          @method('DELETE')

          <div class="modal-header">
            <h5 class="modal-title" id="deleteBusModalLabel{{ $bus->id }}">Delete Bus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            Are you sure you want to delete the bus <strong>{{ $bus->bus_number }}</strong>?
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
