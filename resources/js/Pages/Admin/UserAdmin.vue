<template>
    <div class="container mx-auto p-4 sm:p-6 dark:bg-gray-900 min-h-screen">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center dark:text-white">
            Gestión de usuarios
        </h1>

        <!-- Barra de acciones y búsqueda -->
        <div class="mb-6 sm:mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <a
                :href="route('admin.createUserView')"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200 dark:bg-blue-700 dark:hover:bg-blue-800 w-full sm:w-auto text-center"
            >
                Crear usuario
            </a>

            <!-- Búsqueda -->
            <div class="relative w-full sm:w-64">
                <input
                    type="text"
                    placeholder="Buscar usuario..."
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

        <!-- Tabla de usuarios -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Nombre
                            </th>
                            <th
                                scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell"
                            >
                                Email
                            </th>
                            <th
                                scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Rol
                            </th>
                            <th
                                scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr
                            v-for="user in users.data"
                            :key="user.id"
                            class="hover:bg-gray-50 dark:hover:bg-gray-700"
                        >
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white"
                            >
                                {{ user.name }}
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 hidden sm:table-cell"
                            >
                                {{ user.email }}
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"
                            >
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                    :class="{
                                        'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300': user.role === 'admin',
                                        'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300': user.role === 'user',
                                        'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300': user.role === 'trainer'
                                    }"
                                >
                                    {{ user.role }}
                                </span>
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"
                            >
                                <a
                                    :href="route('admin.userShow', user.id)"
                                    class="text-blue-600 hover:text-blue-900 hover:underline dark:text-blue-400 dark:hover:text-blue-300"
                                >
                                    Ver ficha
                                </a>
                            </td>
                        </tr>
                        <tr v-if="users.data.length === 0">
                            <td colspan="4" class="px-4 sm:px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No se encontraron usuarios
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Mostrando página {{ users.current_page }} de
                {{ users.last_page }}
            </div>

            <div class="flex flex-wrap gap-1">
                <Component
                    :is="link.url ? 'Link' : 'span'"
                    v-for="(link, index) in users.links"
                    :key="index"
                    :href="link.url"
                    class="px-3 py-1 rounded-md border text-sm"
                    :class="{
                        'border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700':
                            link.url && !link.active,
                        'border-blue-500 bg-blue-50 text-blue-600 dark:border-blue-700 dark:bg-blue-900/50 dark:text-blue-200': link.active,
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
    users: Object,
    filters: Object,
});

const search = ref(props.filters.search || "");

watch(
    search,
    debounce((value) => {
        router.get(
            route("admin.userAdmin"),
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
</script>