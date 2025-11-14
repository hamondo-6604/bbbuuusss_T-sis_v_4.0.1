<div id="editModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">Edit Seat Layout</div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label>Layout Name</label>
                <input type="text" name="layout_name" id="editLayoutName" class="form-control" required>
            </div>

            <div class="form-group mb-2">
                <label>Rows</label>
                <input type="number" name="total_rows" id="editRows" class="form-control" required>
            </div>

            <div class="form-group mb-2">
                <label>Columns</label>
                <input type="number" name="total_columns" id="editCols" class="form-control" required>
            </div>

            <div class="form-group mb-2">
                <label>Capacity</label>
                <input type="number" id="editCapacity" class="form-control" readonly>
                <small class="text-muted">Auto-calculated (rows × columns)</small>
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
