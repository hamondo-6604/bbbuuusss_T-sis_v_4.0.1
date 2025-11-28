
<!-- Include main.js -->
<script
  src="{{ asset('dashboard/assets/js/main.js') }}"></script>

<!-- ====== ionicons ======= -->
<script
  type="module"
  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script
  nomodule
  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- Add custom scripts pushed from other views (if any) -->
@stack('scripts')

<!-- ===== Dropdown Toggle Script ===== -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.querySelector('.toggle');
    const dashNav = document.querySelector('.dash-navigation');
    const mainContent = document.querySelector('.main');

    // Hamburger sidebar toggle
    toggleBtn.addEventListener('click', () => {
      dashNav.classList.toggle('active');
      mainContent.classList.toggle('active');

      const icon = toggleBtn.querySelector('ion-icon');
      icon.name = dashNav.classList.contains('active') ? 'close-outline' : 'menu-outline';
    });

    // Submenu toggle
    const submenuToggles = document.querySelectorAll('.toggle-submenu');
    submenuToggles.forEach(toggle => {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        const parentLi = this.parentElement;
        const submenu = parentLi.querySelector('.submenu');
        parentLi.classList.toggle('open');

        if (parentLi.classList.contains('open')) {
          submenu.style.maxHeight = submenu.scrollHeight + "px";
        } else {
          submenu.style.maxHeight = "0";
        }

        const chevronIcon = this.querySelector('.dropdown-icon');
        if (chevronIcon) {
          chevronIcon.name = parentLi.classList.contains('open')
            ? 'chevron-up-outline'
            : 'chevron-down-outline';
        }
      });
    });
  });



</script>

<!-- Vite JavaScript (App JS) -->
@vite('resources/js/app.js') <!-- Ensure this is after other custom scripts -->
</body>
</html>
