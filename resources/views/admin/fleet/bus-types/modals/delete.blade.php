@foreach($busTypes as $busType)
  <div class="modal fade" id="deleteBusTypeModal{{ $busType->id }}" tabindex="-1" aria-labelledby="deleteBusTypeModalLabel{{ $busType->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.bus-types.destroy', $busType->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title" id="deleteBusTypeModalLabel{{ $busType->id }}">Delete Bus Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            Are you sure you want to delete <strong>{{ $busType->type_name }}</strong>?
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
