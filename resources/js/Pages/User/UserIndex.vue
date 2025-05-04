<template>
    <main
        class="container mx-auto py-8 px-4 dark:bg-gray-800 dark:text-gray-600"
    >
        <!-- Mensajes de éxito y error -->
        <section>
            <div
                v-if="props.flash && props.flash.success"
                class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg"
            >
                {{ props.flash.success }}
            </div>

            <div
                v-if="props.flash && props.flash.error"
                class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg"
            >
                {{ props.flash.error }}
            </div>
        </section>

        <!-- Sección de Eventos Destacados -->
        <section class="mb-16 dark:bg-gray-800 dark:text-gray-600">
            <h3 class="text-2xl font-bold mb-6">Actividades más destacadas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="activity in popularAct"
                    :key="activity.id"
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1"
                >
                    <div class="relative h-48 overflow-hidden bg-gray-200">
                        <img
                            :src="activity.image || '/default-sport.jpg'"
                            :alt="activity.name"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-xl font-bold">
                                {{ activity.name }}
                            </h4>
                            <span
                                class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold"
                            >
                                {{ formatDate(activity.date) }}
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ activity.description }}
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 font-medium"
                                >{{ activity.start_time }} -
                                {{ activity.end_time }}</span
                            >

                            <span class="text-lg font-bold text-orange-500"
                                >{{ activity.price }}€</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Todas las Actividades -->
        <section class="mb-16 dark:bg-gray-800 dark:text-gray-600">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Todas las actividades</h3>
                <div class="relative">
                    <input
                        type="text"
                        v-model="filters.search"
                        placeholder="Buscar actividades..."
                        class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    />
                    <svg
                        class="absolute left-3 top-2.5 h-5 w-5 text-gray-400"
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

            <!-- Tabla de actividades -->
            <div
                class="bg-white rounded-xl shadow overflow-hidden dark:bg-gray-800 dark:text-gray-600"
            >
                <div class="overflow-x-auto">
                    <table class="w-full min-w-max">
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
                                    Duración
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Capacidad
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Precio
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
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">
                                        {{ activity.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-600 line-clamp-2">
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

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-600">
                                        {{ formatDate(activity.date) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-600">
                                        {{ activity.start_time }} -
                                        {{ activity.end_time }}
                                    </div>
                                </td>

                                <td>{{ activity.slots }} espacios</td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-600">
                                        {{ activity.price }} €
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-600">
                                        <a
                                            :href="
                                                route(
                                                    'activities.showUserActivity',
                                                    activity.id
                                                )
                                            "
                                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 text-center py-2 px-4 rounded-lg transition-colors mr-2"
                                        >
                                            Detalles
                                        </a>

                                        <a
                                            :href="
                                                route(
                                                    'userActivitiesReservations.create',
                                                    activity.id
                                                )
                                            "
                                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-center py-2 px-4 rounded-lg transition-colors"
                                        >
                                            Reservar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div
                    class="px-6 py-4 border-t border-gray-200 flex items-center justify-between"
                >
                    <div class="text-sm text-gray-600">
                        Mostrando {{ activities.from }} a {{ activities.to }} de
                        {{ activities.total }} actividades
                    </div>
                    <div class="flex space-x-1">
                        <template
                            v-for="(link, index) in activities.links"
                            :key="index"
                        >
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                class="px-3 py-1 rounded-md"
                                :class="{
                                    'bg-orange-500 text-white': link.active,
                                    'bg-white text-gray-700 hover:bg-gray-100':
                                        !link.active,
                                }"
                                v-html="link.label"
                                preserve-scroll
                            />
                            <span
                                v-else
                                class="px-3 py-1 text-gray-400"
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
});

const filters = ref({
    search: props.filters.search || "",
});

// Búsqueda con debounce
watch(
    () => filters.value.search,
    debounce((search) => {
        router.get(
            route("users.index"),
            { search },
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
            }
        );
    }, 300)
);

const formatDate = (dateString) => {
    const options = { weekday: "short", day: "numeric", month: "short" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};
</script>
