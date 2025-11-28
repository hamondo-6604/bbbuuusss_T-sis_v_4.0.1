<!-- resources/views/admin/schedules/modals/delete.blade.php -->
@foreach($schedules as $schedule)
  <div class="modal fade" id="deleteScheduleModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="deleteScheduleModalLabel{{ $schedule->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title" id="deleteScheduleModalLabel{{ $schedule->id }}">Delete Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this schedule?
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
