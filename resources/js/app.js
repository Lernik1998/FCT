import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { Head, Link } from "@inertiajs/vue3";
import { createPinia } from "pinia"; // Importamos Pinia
import { i18nVue } from "laravel-vue-i18n";

const pinia = createPinia(); // instanciamos Pinia

// const appName = import.meta.env.VITE_APP_NAME || "FitWorking";

const appName = "FitWorking";
import PublicLayout from "./Layouts/PublicLayout.vue";

createInertiaApp({
    title: (title) => `${appName} | ${title}`,
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );

        // Espera a que se resuelva la promesa
        return page.then((module) => {
            // Si el componente de página no tiene un layout definido, establece PublicLayout como predeterminado
            if (!module.default.layout) {
                module.default.layout = PublicLayout;
            }
            return module;
        });

        // Antes de la modificacion
        // return resolvePageComponent(
        //     `./Pages/${name}.vue`,
        //     import.meta.glob("./Pages/**/*.vue")
        // ).then((module) => {
        //     // Layout por defecto si no está definido
        //     if (!module.default.layout) {
        //         module.default.layout = PublicLayout;
        //     }
        //     return module;
        // });
    },

    setup({ el, App, props, plugin }) {
        // Se pueden registrar componentes globales
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia) // Usamos Pinia
            .use(i18nVue, {
                resolve: (lang) => {
                    const langs = import.meta.glob("../../lang/*.json", {
                        eager: true,
                    });
                    return langs[`../../lang/${lang}.json`].default;
                },
            })
            .component("Head", Head)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        color: "#f97316",
    },
});
