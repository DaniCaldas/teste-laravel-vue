import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h } from 'vue';
import { vMaska } from "maska/vue"
import { ZiggyVue } from 'ziggy-js';
import Toast from 'vue-toastification';
import AppLayout from './Pages/Layout/AppLayout.vue';
import 'vue-toastification/dist/index.css';
import '../css/app.css';
import './bootstrap';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        const page = pages[`./Pages/${name}.vue`]
        page.default.layout ??= (name => {
            if (name === 'Login/Login') return null
            return AppLayout
        })(name)
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Toast, {
                position: "bottom-center",
                timeout: 3000,
                closeOnClick: true,
                pauseOnFocusLoss: true,
                pauseOnHover: true,
                draggable: true,
                draggablePercent: 0.6,
                showCloseButtonOnHover: false,
                hideProgressBar: true,
                closeButton: "button",
                icon: true,
                rtl: false
            })
            .directive('maska', vMaska)
            .mount(el)
    },
})