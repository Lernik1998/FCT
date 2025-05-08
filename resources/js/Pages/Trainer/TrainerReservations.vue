<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Gestión de Reservas</h1>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="activity in activities"
                :key="activity.id"
                class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200"
            >
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2">
                        {{ activity.name }}
                    </h2>
                    <p class="text-gray-600 mb-1">
                        <strong>Fecha:</strong> {{ formatDate(activity.date) }}
                    </p>
                    <p class="text-gray-600 mb-1">
                        <strong>Horario:</strong> {{ activity.start_time }} -
                        {{ activity.end_time }}
                    </p>

                    <div class="mt-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-medium">Plazas:</span>
                            <span
                                >{{ getReservedSlots(activity.id) }}/{{
                                    activity.slots
                                }}</span
                            >
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div
                                class="bg-blue-600 h-2.5 rounded-full"
                                :style="`width: ${
                                    (getReservedSlots(activity.id) /
                                        activity.slots) *
                                    100
                                }%`"
                                :class="{
                                    'bg-green-500':
                                        getReservedSlots(activity.id) /
                                            activity.slots <
                                        0.7,
                                    'bg-yellow-500':
                                        getReservedSlots(activity.id) /
                                            activity.slots >=
                                            0.7 &&
                                        getReservedSlots(activity.id) /
                                            activity.slots <
                                            0.9,
                                    'bg-red-500':
                                        getReservedSlots(activity.id) /
                                            activity.slots >=
                                        0.9,
                                }"
                            ></div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h3 class="font-medium mb-2">Clientes inscritos:</h3>
                        <ul
                            v-if="
                                getActivityReservations(activity.id).length > 0
                            "
                            class="space-y-1"
                        >
                            <li
                                v-for="reservation in getActivityReservations(
                                    activity.id
                                )"
                                :key="reservation.id"
                                class="text-sm text-gray-600"
                            >
                                {{ reservation.user?.name || "Cliente" }}
                            </li>
                        </ul>
                        <p v-else class="text-sm text-gray-500">
                            No hay reservas aún
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import TrainerLayout from "@/Layouts/TrainerLayout.vue";
import { usePoll } from "@inertiajs/vue3";

usePoll(2000, {
    // only: ["activities", "reservations"],
});

defineOptions({
    layout: TrainerLayout,
});

const props = defineProps({
    activities: Array,
    reservations: Array,
});

// Formatear fecha
const formatDate = (dateString) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

// Obtener reservas para una actividad específica
const getActivityReservations = (activityId) => {
    return props.reservations.filter((r) => r.activity_id === activityId);
};

// Obtener número de plazas reservadas para una actividad
const getReservedSlots = (activityId) => {
    return getActivityReservations(activityId).length;
};
</script>

<style scoped>
/* Estilos opcionales para mejorar la visualización */
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
