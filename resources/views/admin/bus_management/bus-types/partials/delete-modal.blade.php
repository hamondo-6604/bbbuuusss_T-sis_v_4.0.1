<div id="deleteModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">Confirm Delete</div>
        <p>Are you sure you want to delete <strong id="deleteTypeName"></strong>?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>
