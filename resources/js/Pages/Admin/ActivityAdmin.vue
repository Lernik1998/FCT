<template>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">
            Gestión de Actividades
        </h1>

        <!-- Barra de acciones y búsqueda -->
        <div class="mb-10 flex justify-between items-center">
            <a
                :href="route('admin.createActivityView')"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200"
            >
                Crear Actividad
            </a>

            <!-- Búsqueda -->
            <div class="relative">
                <input
                    type="text"
                    placeholder="Buscar actividad..."
                    v-model="search"
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
                />
                <svg
                    class="absolute left-3 top-2.5 h-5 w-5 text-gray-400"
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
        <div class="bg-white shadow-md rounded-lg overflow-y-auto h-96">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Nombre
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Descripción
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Fecha
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Precio
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Estado
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr
                        v-for="activity in activities.data"
                        :key="activity.id"
                        class="hover:bg-gray-50"
                    >
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                        >
                            {{ activity.name }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate"
                        >
                            {{ activity.description }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ formatDate(activity.date) }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ formatCurrency(activity.price) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span :class="statusClass(activity.status)">
                                {{ statusText(activity.status) }}
                            </span>
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                        >
                            <div class="flex space-x-2">
                                <a
                                    :href="
                                        route('admin.activityShow', activity.id)
                                    "
                                    class="text-blue-600 hover:text-blue-900 hover:underline"
                                >
                                    Ver
                                </a>
                                <a
                                    :href="
                                        route('admin.activityEdit', activity.id)
                                    "
                                    class="text-yellow-600 hover:text-yellow-900 hover:underline"
                                >
                                    Editar
                                </a>
                                <button
                                    @click="deleteActivity(activity.id)"
                                    class="text-red-600 hover:text-red-900 hover:underline"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                Mostrando página {{ activities.current_page }} de
                {{ activities.last_page }}
            </div>

            <div class="flex space-x-1">
                <Component
                    :is="link.url ? 'Link' : 'span'"
                    v-for="(link, index) in activities.links"
                    :key="index"
                    :href="link.url"
                    class="px-3 py-1 rounded-md border"
                    :class="{
                        'border-gray-300 text-gray-500 hover:bg-gray-50':
                            link.url && !link.active,
                        'border-blue-500 bg-blue-50 text-blue-600': link.active,
                        'border-gray-200 text-gray-400 cursor-not-allowed':
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
        active: "bg-green-100 text-green-800",
        inactive: "bg-red-100 text-red-800",
        pending: "bg-yellow-100 text-yellow-800",
    };
    return `${
        classes[status] || "bg-gray-100 text-gray-800"
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
