<!-- Delete Bus Modal -->
@foreach($buses as $bus)
<div class="modal fade" id="deleteBusModal{{ $bus->id }}" tabindex="-1" aria-labelledby="deleteBusModalLabel{{ $bus->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteBusModalLabel{{ $bus->id }}">Delete Bus: {{ $bus->bus_number }}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete <strong>{{ $bus->bus_number }}</strong>?</p>
          <p class="text-danger"><small>This action cannot be undone.</small></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach
