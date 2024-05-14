import './bootstrap';
import '../scss/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createStore } from 'vuex';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const store = createStore({
    state() {
        return {
            loader: false
        }
    },
    mutations: {
        toggleLoader(state) {
            state.loader = !state.loader;
        }
    }
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(store)
            .mount(el);
    
        return app;
    },
    progress: {
        color: '#4B5563',
    },
});

