// Make modal functions globally available
window.closeModal = function(id) {
    const modal = document.getElementById(id);
    if (modal) modal.style.display = 'none';
};

window.openModal = function(id) {
    const modal = document.getElementById(id);
    if (modal) modal.style.display = 'flex';
};

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('editForm');
  const deleteForm = document.getElementById('deleteForm');

  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('editTypeName').value = btn.dataset.name;
      document.getElementById('editSeatLayout').value = btn.dataset.layout;
      document.getElementById('editStatus').value = btn.dataset.status;
      document.getElementById('editDescription').value = btn.dataset.description;
      editForm.action = `/admin/bus-types/${btn.dataset.id}`;
      openModal('editModal');
    });
  });

  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('deleteTypeName').textContent = btn.dataset.name;
      deleteForm.action = `/admin/bus-types/${btn.dataset.id}`;
      openModal('deleteModal');
    });
  });
});
