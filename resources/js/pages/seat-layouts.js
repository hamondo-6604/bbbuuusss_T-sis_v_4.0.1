// resources/js/pages/seat-layouts.js
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

function openModal(id) {
    document.getElementById(id).style.display = 'flex';
}

document.addEventListener('DOMContentLoaded', () => {
    const editForm = document.getElementById('editForm');
    const deleteForm = document.getElementById('deleteForm');

    // Edit button click
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            document.getElementById('editLayoutName').value = btn.dataset.name;
            document.getElementById('editRows').value = btn.dataset.rows;
            document.getElementById('editCols').value = btn.dataset.cols;
            document.getElementById('editStatus').value = btn.dataset.status;
            document.getElementById('editDescription').value = btn.dataset.description;
            document.getElementById('editCapacity').value = btn.dataset.rows * btn.dataset.cols;

            editForm.action = `/admin/seat-layouts/${id}`;
            openModal('editModal');
        });
    });

    // Delete button click
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            document.getElementById('deleteLayoutName').textContent = btn.dataset.name;
            deleteForm.action = `/admin/seat-layouts/${id}`;
            openModal('deleteModal');
        });
    });

    // Auto-calc capacity on edit
    document.getElementById('editRows').addEventListener('input', calcCap);
    document.getElementById('editCols').addEventListener('input', calcCap);
    function calcCap() {
        const r = parseInt(document.getElementById('editRows').value) || 0;
        const c = parseInt(document.getElementById('editCols').value) || 0;
        document.getElementById('editCapacity').value = r * c;
    }
});
