// ==============================
// Import global dependencies
// ==============================
import './bootstrap'; // e.g., axios setup, global configuration

// ==============================
// Layout scripts (always loaded)
// ==============================
import './layout/header';
import './layout/footer';
import './layout/sidebar';

// ==============================
// Shared components (always loaded)
// ==============================
import './components/alerts';
import './components/modal';
import './components/tooltip';

// ==============================
// Global utils
// ==============================
import * as formHelpers from './utils/formHelpers';
import * as domUtils from './utils/domUtils';

// ==============================
// Page-specific scripts
// Dynamically load modules based on body[data-page]
// ==============================
const page = document.body.dataset.page || '';

switch (page) {
    case 'admin.bus_management.seat_layout.create':
    case 'admin.bus_management.seat_layout.edit':
        import('./pages/admin/bus_management/seat_layout').then(module => {
            module.init();
        });
        break;

    case 'admin.dashboard':
        import('./pages/admin/dashboard').then(module => {
            module.init();
        });
        break;

    case 'user.dashboard':
        import('./pages/user/dashboard').then(module => {
            module.init();
        });
        break;

    case 'user.profile':
        import('./pages/user/profile').then(module => {
            module.init();
        });
        break;

    // Add more page-specific modules as needed
    default:
        break;
}
