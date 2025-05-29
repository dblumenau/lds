import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';

// Alpine.js initialization
window.Alpine = Alpine;
Alpine.start();

// Vue.js initialization
const app = createApp({});

// Auto-register Vue components
const components = import.meta.glob('./components/**/*.vue', { eager: true });

Object.entries(components).forEach(([path, definition]) => {
    const componentName = path.split('/').pop().replace(/\.\w+$/, '');
    app.component(componentName, definition.default);
});

// Mount Vue app if there's a #vue-app element
if (document.getElementById('vue-app')) {
    app.mount('#vue-app');
}
