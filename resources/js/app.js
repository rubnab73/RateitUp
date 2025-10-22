import './bootstrap';
import Alpine from 'alpinejs';

// Ensure Alpine is only loaded once
if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
