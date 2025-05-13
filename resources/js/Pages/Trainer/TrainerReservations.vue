<template>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold dark:text-orange-600">Gestión de Reservas</h1>
            <div class="relative w-64">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Buscar actividades..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500"
                    @input="debouncedSearch"
                />
                <svg
                    class="absolute left-3 top-2.5 h-5 w-5 text-gray-400 dark:text-gray-300"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
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

        <!-- Sección de Próximas Actividades -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 dark:text-white">Próximas Actividades</h2>
            <div v-if="upcomingActivities.length > 0" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="activity in upcomingActivities"
                    :key="activity.id"
                    class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                >
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 dark:text-white">
                            {{ activity.name }}
                        </h3>
                        <p class="text-gray-600 mb-1 dark:text-gray-300">
                            <strong class="dark:text-gray-200">Fecha:</strong> {{ formatDate(activity.date) }}
                        </p>
                        <p class="text-gray-600 mb-1 dark:text-gray-300">
                            <strong class="dark:text-gray-200">Horario:</strong> {{ activity.start_time }} - {{ activity.end_time }}
                        </p>

                        <div class="mt-4">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-medium dark:text-gray-200">Plazas:</span>
                                <span class="dark:text-gray-300">
                                    {{ getReservedSlots(activity.id) }}/{{ activity.slots }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div
                                    class="h-2.5 rounded-full"
                                    :style="`width: ${occupancyPercentage(activity.id)}%`"
                                    :class="{
                                        'bg-green-500': occupancyPercentage(activity.id) < 70,
                                        'bg-yellow-500': occupancyPercentage(activity.id) >= 70 && occupancyPercentage(activity.id) < 90,
                                        'bg-red-500': occupancyPercentage(activity.id) >= 90,
                                    }"
                                ></div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="font-medium mb-2 dark:text-gray-200">Clientes inscritos:</h3>
                            <ul
                                v-if="getActivityReservations(activity.id).length > 0"
                                class="space-y-1"
                            >
                                <li
                                    v-for="reservation in getActivityReservations(activity.id)"
                                    :key="reservation.id"
                                    class="text-sm text-gray-600 dark:text-gray-300"
                                >
                                    {{ reservation.user?.name || "Cliente" }}
                                </li>
                            </ul>
                            <p v-else class="text-sm text-gray-500 dark:text-gray-400">
                                No hay reservas aún
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="bg-white p-6 rounded-lg shadow border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300">No hay actividades próximas programadas.</p>
            </div>
        </section>

        <!-- Sección de Todas las Actividades -->
        <section>
            <h2 class="text-2xl font-semibold mb-6 dark:text-white">Todas las Actividades</h2>
            
            <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                    Nombre
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                    Fecha
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                    Horario
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                    Plazas
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                    Estado
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                    Reservas
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="activity in activities.data" :key="activity.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ activity.name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ activity.description.substring(0, 30) }}...
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ formatDate(activity.date) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ activity.start_time }} - {{ activity.end_time }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ getReservedSlots(activity.id) }}/{{ activity.slots }}
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1 dark:bg-gray-700">
                                        <div
                                            class="h-1.5 rounded-full"
                                            :style="`width: ${occupancyPercentage(activity.id)}%`"
                                            :class="{
                                                'bg-green-500': occupancyPercentage(activity.id) < 70,
                                                'bg-yellow-500': occupancyPercentage(activity.id) >= 70 && occupancyPercentage(activity.id) < 90,
                                                'bg-red-500': occupancyPercentage(activity.id) >= 90,
                                            }"
                                        ></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        :class="{
                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': isUpcoming(activity.date),
                                            'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300': !isUpcoming(activity.date),
                                        }"
                                    >
                                        {{ isUpcoming(activity.date) ? 'Próxima' : 'Pasada' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ getActivityReservations(activity.id).length }}
                                </td>
                            </tr>
                            <tr v-if="activities.data.length === 0">
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No se encontraron actividades
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Paginación -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 dark:bg-gray-800 dark:border-gray-700">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                Mostrando
                                <span class="font-medium dark:text-white">{{ activities.from }}</span>
                                a
                                <span class="font-medium dark:text-white">{{ activities.to }}</span>
                                de
                                <span class="font-medium dark:text-white">{{ activities.total }}</span>
                                resultados
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <Link
                                    v-for="(link, index) in activities.links"
                                    :key="index"
                                    :href="link.url || '#'"
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium dark:border-gray-600"
                                    :class="{
                                        'bg-blue-50 border-blue-500 text-blue-600 dark:bg-blue-900 dark:text-blue-200 dark:border-blue-700': link.active,
                                        'bg-white text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600': !link.active && link.url,
                                        'text-gray-300 dark:text-gray-500': !link.url,
                                    }"
                                    v-html="link.label"
                                />
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import TrainerLayout from '@/Layouts/TrainerLayout.vue';

defineOptions({
    layout: TrainerLayout,
});

const props = defineProps({
    activities: Object,
    reservations: Array,
    filters: Object,
});

const search = ref(props.filters.search || '');

// Filtrar actividades próximas (para la sección de cards)
const upcomingActivities = computed(() => {
    const today = new Date().toISOString().split('T')[0];
    return props.activities.data.filter(activity => activity.date >= today).slice(0, 6);
});

// Función para determinar si una actividad es próxima
const isUpcoming = (date) => {
    const today = new Date().toISOString().split('T')[0];
    return date >= today;
};

// Función para calcular porcentaje de ocupación
const occupancyPercentage = (activityId) => {
    const activity = props.activities.data.find(a => a.id === activityId);
    if (!activity || activity.slots === 0) return 0;
    return Math.round((getReservedSlots(activityId) / activity.slots) * 100);
};

// Formatear fecha
const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('es-ES', options);
};

// Obtener reservas para una actividad específica
const getActivityReservations = (activityId) => {
    return props.reservations.filter((r) => r.activity_id === activityId);
};

// Obtener número de plazas reservadas para una actividad
const getReservedSlots = (activityId) => {
    return getActivityReservations(activityId).length;
};

// Búsqueda debounceada
const debouncedSearch = debounce(() => {
    const params = new URLSearchParams(window.location.search);
    if (search.value) {
        params.set('search', search.value);
    } else {
        params.delete('search');
    }
    window.location.href = `${window.location.pathname}?${params.toString()}`;
}, 500);
</script>

<style scoped>
.container {
    max-width: 1200px;
}
.bg-green-500 {
    background-color: #10b981;
}
.bg-yellow-500 {
    background-color: #f59e0b;
}
.bg-red-500 {
    background-color: #ef4444;
}
</style>