<template>
    <main
        class="mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900 min-h-screen transition-colors duration-300"
    >
        <!-- Mensajes flash -->
        <section>
            <div
                v-if="$page.props.flash.message"
                class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg transition-colors duration-300"
            >
                {{ $page.props.flash.message }}
            </div>
        </section>

        <!-- Sección de Eventos Destacados -->
        <section class="mb-12 md:mb-16">
            <h3
                class="text-2xl md:text-3xl font-bold mb-6 text-gray-800 dark:text-orange-400"
            >
                Próximas actividades
            </h3>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                <div
                    v-for="activity in popularAct"
                    :key="activity.id"
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200 dark:border-gray-700"
                >
                    <div
                        class="relative h-48 overflow-hidden bg-gray-200 dark:bg-gray-700"
                    >
                        <img
                            :src="activity.image || '/default-sport.jpg'"
                            :alt="activity.name"
                            class="w-full h-full object-cover"
                            loading="lazy"
                        />
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <h4
                                class="text-lg font-bold text-gray-800 dark:text-gray-100"
                            >
                                {{ activity.name }}
                            </h4>
                            <span
                                class="bg-orange-500 dark:bg-orange-600 text-white px-3 py-1 rounded-full text-xs sm:text-sm font-bold"
                            >
                                {{ formatDate(activity.date) }}
                            </span>
                        </div>
                        <p
                            class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2 text-sm"
                        >
                            {{ activity.description }}
                        </p>
                        <div class="flex justify-between items-center">
                            <span
                                class="text-gray-700 dark:text-gray-400 font-medium text-sm"
                            >
                                {{ formatTime(activity.start_time) }} -
                                {{ formatTime(activity.end_time) }}
                            </span>
                            <span
                                v-if="!hasMembership"
                                class="text-lg font-bold text-orange-500 dark:text-orange-400"
                            >
                                {{ activity.price }} €
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Todas las Actividades -->
        <section class="mb-12 md:mb-16">
            <div
                class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4"
            >
                <h3
                    class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-100"
                >
                    Todas las actividades
                </h3>

                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                    <div class="relative w-full sm:w-64">
                        <input
                            type="text"
                            v-model="filters.search"
                            placeholder="Buscar actividades..."
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                        />
                        <svg
                            class="absolute left-3 top-2.5 h-5 w-5 text-gray-400 dark:text-gray-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Botones de categorías -->
            <div class="mb-6 flex flex-wrap gap-2">
                <button
                    @click="setCategoryFilter('all')"
                    :class="{
                        'bg-orange-500 dark:bg-orange-600 text-white':
                            !filters.category || filters.category === 'all',
                        'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200':
                            filters.category && filters.category !== 'all',
                    }"
                    class="px-4 py-2 rounded-lg transition-colors text-sm sm:text-base"
                >
                    Todas
                </button>
                <button
                    v-for="category in $page.props.categories"
                    :key="category.id"
                    @click="setCategoryFilter(category.name)"
                    :class="{
                        'bg-orange-500 dark:bg-orange-600 text-white':
                            filters.category === category.name,
                        'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200':
                            filters.category !== category.name,
                    }"
                    class="px-4 py-2 rounded-lg transition-colors text-sm sm:text-base"
                >
                    {{ category.name }}
                </button>
            </div>

            <!-- Tabla de actividades -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-300"
            >
                <div class="overflow-x-auto">
                    <table class="w-full min-w-max">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                >
                                    Nombre
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell"
                                >
                                    Descripción
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                >
                                    Fecha
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                >
                                    Horario
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell"
                                >
                                    Capacidad
                                </th>
                                <th
                                    v-if="!hasMembership"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                >
                                    Precio
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
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
                                class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150"
                            >
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div
                                        class="font-medium text-gray-900 dark:text-gray-100"
                                    >
                                        {{ activity.name }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 hidden sm:table-cell">
                                    <div
                                        class="text-gray-600 dark:text-gray-300 line-clamp-2 text-sm"
                                    >
                                        {{
                                            activity.description.length < 50
                                                ? activity.description
                                                : activity.description.slice(
                                                      0,
                                                      50
                                                  ) + "..."
                                        }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div
                                        class="text-gray-600 dark:text-gray-300 text-sm"
                                    >
                                        {{ formatDate(activity.date) }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div
                                        class="text-gray-600 dark:text-gray-300 text-sm"
                                    >
                                        {{ formatTime(activity.start_time) }} -
                                        {{ formatTime(activity.end_time) }}
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 whitespace-nowrap hidden lg:table-cell"
                                >
                                    <div
                                        class="text-gray-600 dark:text-gray-300"
                                    >
                                        {{ activity.slots }} plazas
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 whitespace-nowrap"
                                    v-if="!hasMembership"
                                >
                                    <div
                                        class="text-gray-600 dark:text-gray-300 font-medium"
                                    >
                                        {{ activity.price }} €
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div
                                        class="flex flex-col sm:flex-row gap-2"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'activities.showUserActivity',
                                                    activity.id
                                                )
                                            "
                                            class="bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-100 py-1 px-3 rounded text-sm text-center transition-colors"
                                        >
                                            Detalles
                                        </Link>
                                        <Link
                                            :href="
                                                route(
                                                    'userActivitiesReservations.create',
                                                    activity.id
                                                )
                                            "
                                            class="bg-orange-500 dark:bg-orange-600 hover:bg-orange-600 dark:hover:bg-orange-700 text-white py-1 px-3 rounded text-sm text-center transition-colors"
                                        >
                                            Reservar
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div
                    class="px-4 sm:px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-4"
                >
                    <div class="text-sm text-gray-600 dark:text-gray-300">
                        Mostrando {{ activities.from }} a {{ activities.to }} de
                        {{ activities.total }} actividades
                    </div>
                    <div class="flex flex-wrap gap-1">
                        <template
                            v-for="(link, index) in activities.links"
                            :key="index"
                        >
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                class="px-3 py-1 rounded-md text-sm"
                                :class="{
                                    'bg-orange-500 dark:bg-orange-600 text-white':
                                        link.active,
                                    'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600':
                                        !link.active,
                                }"
                                v-html="link.label"
                                preserve-scroll
                            />
                            <span
                                v-else
                                class="px-3 py-1 text-gray-400 dark:text-gray-500 text-sm"
                                v-html="link.label"
                            ></span>
                        </template>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { debounce } from "lodash";
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
    user: Object,
    activities: Object,
    popularAct: Array,
    filters: Object,
    flash: Object,
    categories: Array,
    hasMembership: Boolean,
});

const filters = ref({
    search: props.filters.search || "",
    category: props.filters.category || "all",
    showFilters: false,
});

// Búsqueda con debounce
watch(
    () => filters.value.search,
    debounce((search) => {
        router.get(
            route("users.index"),
            {
                search,
                category:
                    filters.value.category === "all"
                        ? ""
                        : filters.value.category,
            },
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
            }
        );
    }, 300)
);

// Función para filtrar por categoría
const setCategoryFilter = (category) => {
    filters.value.category = category;
    router.get(
        route("users.index"),
        {
            category: category === "all" ? "" : category,
            search: filters.value.search,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        }
    );
};

const formatDate = (dateString) => {
    const options = { weekday: "short", day: "numeric", month: "short" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

// Formatear hora (mostrar solo horas y minutos)
const formatTime = (timeString) => {
    if (!timeString) return ""; // Manejo de casos nulos

    // Dividir la cadena de tiempo y tomar solo horas y minutos
    const [hours, minutes] = timeString.split(":");

    // Formatear como "HH:MM" (por ejemplo "09:30")
    return `${hours}:${minutes}`;

    // O alternativamente como "9h 30m":
    // return `${hours}h ${minutes}m`;
};
</script>
