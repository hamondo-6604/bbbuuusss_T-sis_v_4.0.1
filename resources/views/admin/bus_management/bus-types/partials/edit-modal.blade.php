<div id="editModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">Edit Bus Type</div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-2">
                <label>Type Name</label>
                <input type="text" name="type_name" id="editTypeName" class="form-control" required>
            </div>

            <div class="form-group mb-2">
                <label>Seat Layout</label>
                <select name="seat_layout_id" id="editSeatLayout" class="form-control">
                    @foreach($seatLayouts as $layout)
                        <option value="{{ $layout->id }}">{{ $layout->layout_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <label>Status</label>
                <select name="status" id="editStatus" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label>Description</label>
                <textarea name="description" id="editDescription" class="form-control" rows="3"></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Cancel</button>
                <button type="submit" class="btn btn-info">Save Changes</button>
            </div>
        </form>
    </div>
</div>
