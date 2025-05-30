<template>
    <Head title="Gestión de actividades" />

    <div class="container mx-auto p-4 sm:p-6 dark:bg-gray-900 min-h-screen">
        <!-- Botón de volver -->
        <button
            @click="() => router.visit(route('admin.index'))"
            class="mb-4 bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
            type="button"
        >
            <div
                class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1024 1024"
                    height="25px"
                    width="25px"
                >
                    <path
                        d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                        fill="#000000"
                    ></path>
                    <path
                        d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                        fill="#000000"
                    ></path>
                </svg>
            </div>
            <p class="translate-x-2">Volver</p>
        </button>

        <h1
            class="text-2xl sm:text-3xl font-bold mb-6 text-center dark:text-white"
        >
            Gestión de Actividades
        </h1>

        <!-- Barra de acciones y búsqueda -->
        <div
            class="mb-6 sm:mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4"
        >
            <a
                :href="route('admin.createActivityView')"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200 dark:bg-blue-700 dark:hover:bg-blue-800 w-full sm:w-auto text-center"
            >
                Crear Actividad
            </a>

            <!-- Búsqueda -->
            <div class="relative w-full sm:w-64">
                <input
                    type="text"
                    placeholder="Buscar actividad..."
                    v-model="search"
                    class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
                />
                <svg
                    class="absolute left-3 top-2.5 h-5 w-5 text-gray-400 dark:text-gray-300"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    ></path>
                </svg>
            </div>
        </div>

        <!-- Tabla de actividades -->
        <div
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden"
        >
            <div class="overflow-x-auto max-h-96 sm:max-h-full">
                <table
                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Nombre
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell"
                            >
                                Descripción
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Fecha
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell"
                            >
                                Precio
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Estado
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <tr
                            v-for="activity in activities.data"
                            :key="activity.id"
                            class="hover:bg-gray-50 dark:hover:bg-gray-700"
                        >
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"
                            >
                                {{ activity.name }}
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 text-sm text-gray-500 dark:text-gray-300 max-w-xs truncate hidden sm:table-cell"
                            >
                                {{ activity.description }}
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"
                            >
                                {{ formatDate(activity.date) }}
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 hidden md:table-cell"
                            >
                                {{ formatCurrency(activity.price) }}
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm"
                            >
                                <span :class="statusClass(activity.status)">
                                    {{ statusText(activity.status) }}
                                </span>
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium"
                            >
                                <div class="flex space-x-2">
                                    <a
                                        :href="
                                            route(
                                                'admin.activityShow',
                                                activity.id
                                            )
                                        "
                                        class="text-blue-600 hover:text-blue-900 hover:underline dark:text-blue-400 dark:hover:text-blue-300"
                                    >
                                        Ver
                                    </a>
                                    <a
                                        :href="
                                            route(
                                                'admin.activityEdit',
                                                activity.id
                                            )
                                        "
                                        class="text-yellow-600 hover:text-yellow-900 hover:underline dark:text-yellow-400 dark:hover:text-yellow-300"
                                    >
                                        Editar
                                    </a>
                                    <button
                                        @click="deleteActivity(activity.id)"
                                        class="text-red-600 hover:text-red-900 hover:underline dark:text-red-400 dark:hover:text-red-300"
                                    >
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="activities.data.length === 0">
                            <td
                                colspan="6"
                                class="px-4 sm:px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400"
                            >
                                No se encontraron actividades
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <div
            class="mt-4 sm:mt-6 flex flex-col sm:flex-row items-center justify-between gap-4"
        >
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Mostrando página {{ activities.current_page }} de
                {{ activities.last_page }}
            </div>

            <div class="flex flex-wrap gap-1">
                <Component
                    :is="link.url ? 'Link' : 'span'"
                    v-for="(link, index) in activities.links"
                    :key="index"
                    :href="link.url"
                    class="px-3 py-1 rounded-md border text-sm"
                    :class="{
                        'border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700':
                            link.url && !link.active,
                        'border-blue-500 bg-blue-50 text-blue-600 dark:border-blue-700 dark:bg-blue-900/50 dark:text-blue-200':
                            link.active,
                        'border-gray-200 text-gray-400 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed':
                            !link.url,
                    }"
                    v-html="translatePaginationLabel(link.label)"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({
    activities: Object,
    filters: Object,
});

const search = ref(props.filters.search || "");

watch(
    search,
    debounce((value) => {
        router.get(
            route("admin.activityAdmin"),
            { search: value },
            {
                preserveState: true,
                replace: true,
                preserveScroll: true,
            }
        );
    }, 300)
);

// Función para traducir las etiquetas de paginación
const translatePaginationLabel = (label) => {
    const translations = {
        "&laquo; Previous": "&laquo; Anterior",
        "Next &raquo;": "Siguiente &raquo;",
        Previous: "Anterior",
        Next: "Siguiente",
    };

    return translations[label] || label;
};

const statusClass = (status) => {
    const classes = {
        active: "bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300",
        inactive:
            "bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300",
        pending:
            "bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300",
    };
    return `${
        classes[status] ||
        "bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300"
    } inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium`;
};

const statusText = (status) => {
    const texts = {
        active: "Activo",
        inactive: "Inactivo",
        pending: "Pendiente",
    };
    return texts[status] || status;
};

const formatDate = (dateString) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

const formatCurrency = (amount) => {
    return new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR",
    }).format(amount);
};

const deleteActivity = (id) => {
    if (confirm("¿Seguro que deseas eliminar esta actividad?")) {
        router.delete(route("admin.activityDestroy", id));
    }
};
</script>
