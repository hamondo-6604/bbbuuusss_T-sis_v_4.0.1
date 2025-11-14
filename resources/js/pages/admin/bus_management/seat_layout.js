export function init() {
    const rows = document.getElementById('total_rows');
    const cols = document.getElementById('total_columns');
    const capacity = document.getElementById('capacity');
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');

    // If any required element is missing, do nothing
    if (!rows || !cols || !capacity || !form || !submitBtn) {
        return;
    }

    // Auto-calculate capacity based on rows and columns inputs
    function updateCapacity() {
        const r = parseInt(rows.value) || 0;
        const c = parseInt(cols.value) || 0;
        capacity.value = r * c;
    }

    rows.addEventListener('input', updateCapacity);
    cols.addEventListener('input', updateCapacity);

    // Disable submit button on form submission to prevent multiple submits
    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';
    });
}
