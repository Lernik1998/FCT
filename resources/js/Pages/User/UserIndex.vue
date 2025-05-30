<template>
    <Head title="User Index" />

    <main
        class="mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900 min-h-screen transition-colors duration-300"
    >
        <!-- Mensajes flash -->
        <section>
            <div
                v-if="$page.props.flash.message === true"
                class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg transition-colors duration-300"
            >
                Reserva y pago completados con éxito.
            </div>
        </section>

        <!-- Error message -->
        <section v-if="$page.props.flash.message === false">
            <div
                class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg transition-colors duration-300"
            >
                Error al procesar el pago, intentelo de nuevo más tarde.
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
                <Link
                    v-for="activity in popularAct"
                    :key="activity.id"
                    :href="route('activities.showUserActivity', activity.id)"
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200 dark:border-gray-700 cursor-pointer"
                >
                    <div
                        class="relative h-48 overflow-hidden bg-gray-200 dark:bg-gray-700"
                    >
                        <img
                            :src="
                                'images/activities/' + activity.image ||
                                '/default-sport.jpg'
                            "
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
                                class="bg-orange-500 dark:bg-orange-600 text-white px-3 py-1 rounded-full text-xs md:text-sm font-bold"
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
                </Link>
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

            <!-- Versión móvil: Cards -->
            <div class="sm:hidden grid grid-cols-1 gap-4 mb-6">
                <div
                    v-for="activity in activities.data"
                    :key="activity.id"
                    class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-200 dark:border-gray-700"
                >
                    <div class="flex justify-between items-start">
                        <h4 class="font-bold text-gray-900 dark:text-gray-100">
                            {{ activity.name }}
                        </h4>
                        <span
                            class="bg-orange-500 dark:bg-orange-600 text-white px-2 py-1 rounded-full text-xs font-bold"
                        >
                            {{ formatDate(activity.date) }}
                        </span>
                    </div>

                    <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        {{ formatTime(activity.start_time) }} -
                        {{ formatTime(activity.end_time) }}
                    </div>

                    <div
                        v-if="!hasMembership"
                        class="mt-2 text-sm font-medium text-gray-700 dark:text-gray-200"
                    >
                        Precio: {{ activity.price }} €
                    </div>

                    <div class="mt-3 flex gap-2">
                        <Link
                            :href="
                                route(
                                    'activities.showUserActivity',
                                    activity.id
                                )
                            "
                            class="flex-1 bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-100 py-2 px-3 rounded text-sm text-center transition-colors"
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
                            class="flex-1 bg-orange-500 dark:bg-orange-600 hover:bg-orange-600 dark:hover:bg-orange-700 text-white py-2 px-3 rounded text-sm text-center transition-colors"
                        >
                            Reservar
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Versión desktop: Tabla -->
            <div
                class="hidden sm:block bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-300"
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
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
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

    <!-- Modal para reserva duplicada -->
    <div v-if="showDuplicateModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                aria-hidden="true"
                >&#8203;</span
            >

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full dark:bg-gray-800"
            >
                <div
                    class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800"
                >
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-yellow-900"
                        >
                            <svg
                                class="h-6 w-6 text-yellow-600 dark:text-yellow-400"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                />
                            </svg>
                        </div>
                        <div
                            class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                        >
                            <h3
                                class="text-lg leading-6 font-medium text-gray-900 dark:text-white"
                                id="modal-title"
                            >
                                Ya tienes una reserva
                            </h3>
                            <div class="mt-2">
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-300"
                                >
                                    Ya tienes una reserva para otra actividad en
                                    el mismo horario. No puedes reservar dos
                                    actividades a la misma hora.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse dark:bg-gray-700"
                >
                    <button
                        type="button"
                        @click="closeDuplicateModal"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500"
                    >
                        Entendido
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para no hay plazas -->
    <div v-if="showNoSlotsModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                aria-hidden="true"
                >&#8203;</span
            >

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full dark:bg-gray-800"
            >
                <div
                    class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800"
                >
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-red-900"
                        >
                            <svg
                                class="h-6 w-6 text-red-600 dark:text-red-400"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </div>
                        <div
                            class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                        >
                            <h3
                                class="text-lg leading-6 font-medium text-gray-900 dark:text-white"
                                id="modal-title"
                            >
                                No hay plazas disponibles
                            </h3>
                            <div class="mt-2">
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-300"
                                >
                                    Lo sentimos, no quedan plazas disponibles
                                    para esta actividad. Por favor, intenta con
                                    otra actividad u horario.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse dark:bg-gray-700"
                >
                    <button
                        type="button"
                        @click="closeNoSlotsModal"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500"
                    >
                        Entendido
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para reserva con membresía -->
    <div v-if="showMembershipModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                aria-hidden="true"
                >&#8203;</span
            >

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full dark:bg-gray-800"
            >
                <div
                    class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800"
                >
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-green-900"
                        >
                            <svg
                                class="h-6 w-6 text-green-600 dark:text-green-400"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                        <div
                            class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                        >
                            <h3
                                class="text-lg leading-6 font-medium text-gray-900 dark:text-white"
                                id="modal-title"
                            >
                                Reserva confirmada
                            </h3>
                            <div class="mt-2">
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-300"
                                >
                                    ¡Tu reserva ha sido confirmada con éxito
                                    usando tu membresía! No se ha cobrado ningún
                                    importe adicional.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse dark:bg-gray-700"
                >
                    <button
                        type="button"
                        @click="closeMembershipModal"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        ¡Genial!
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref, watch, onMounted } from "vue";
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

// Estados para los modales
const showDuplicateModal = ref(false);
const showNoSlotsModal = ref(false);
const showMembershipModal = ref(false);

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

// Manejar los mensajes flash del backend
onMounted(() => {
    if (props.flash.message === "errorSameTime") {
        showDuplicateModal.value = true;
    } else if (props.flash.message === "errorNoSlots") {
        showNoSlotsModal.value = true;
    } else if (props.flash.message === "successMembership") {
        showMembershipModal.value = true;
    }
});

// Funciones para cerrar modales
const closeDuplicateModal = () => {
    showDuplicateModal.value = false;
    router.get(route("users.index"), {}, { preserveState: true });
};

const closeNoSlotsModal = () => {
    showNoSlotsModal.value = false;
    router.get(route("users.index"), {}, { preserveState: true });
};

const closeMembershipModal = () => {
    showMembershipModal.value = false;
    router.get(route("users.index"), {}, { preserveState: true });
};
</script>
