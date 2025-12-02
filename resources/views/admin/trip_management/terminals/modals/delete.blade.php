@foreach($terminals as $terminal)
<div class="modal fade" id="deleteTerminalModal{{ $terminal->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('admin.terminals.destroy', $terminal->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Delete Terminal</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body text-center">
          <p class="fw-bold">Are you sure you want to delete this terminal?</p>
          <p class="text-muted mb-0">
            <strong>{{ $terminal->name }}</strong><br>
            {{ $terminal->city->name ?? 'N/A' }}
          </p>
        </div>

        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>

      </form>

    </div>
  </div>
</div>
@endforeach
