<template>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Gestión de usuarios</h1>

        <!-- Barra de acciones y búsqueda -->
        <div class="mb-10 flex justify-between items-center">
            <a
                :href="route('admin.createUserView')"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200"
            >
                Crear usuario
            </a>

            <!-- Búsqueda -->
            <div class="relative">
                <input
                    type="text"
                    placeholder="Buscar usuario..."
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

        <!-- Tabla de usuarios -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Nombre
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Email
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Rol
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr
                        v-for="user in users.data"
                        :key="user.id"
                        class="hover:bg-gray-50"
                    >
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                        >
                            {{ user.name }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ user.email }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ user.role }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            <a
                                :href="route('admin.userShow', user.id)"
                                class="text-blue-600 hover:text-blue-900 hover:underline"
                            >
                                Ver ficha
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                Mostrando página {{ users.current_page }} de
                {{ users.last_page }}
            </div>

            <div class="flex space-x-1">
                <Component
                    :is="link.url ? 'Link' : 'span'"
                    v-for="(link, index) in users.links"
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
