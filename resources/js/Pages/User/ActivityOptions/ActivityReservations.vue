<template>
    <!-- Contenido Principal -->
    <main
        class="w-full min-h-screen mx-auto py-8 px-4 sm:px-6 dark:bg-gray-900 transition-colors duration-300"
    >
        <!-- Encabezado -->
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8"
        >
            <div>
                <h1
                    class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center dark:text-orange-600"
                >
                    Reservas
                </h1>
                <p class="text-gray-600 mt-2 dark:text-white">
                    Revisa y gestiona todas tus actividades reservadas
                </p>
            </div>

            <div class="mt-4 md:mt-0">
                <div
                    class="flex flex-col sm:flex-row gap-4 mb-8 items-center justify-between"
                >
                    <div class="flex gap-3 w-full sm:w-auto">
                        <!-- Selector de filtro -->
                        <div class="relative inline-block w-full md:w-64">
                            <select
                                v-model="filter"
                                class="appearance-none bg-white border border-gray-300 rounded-full px-5 py-3 pr-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 w-full transition-all duration-200 hover:border-orange-400"
                            >
                                <option class="text-gray-400" disabled selected>
                                    Filtrar por estado
                                </option>
                                <option value="all" class="text-gray-700">
                                    Todas
                                </option>
                                <option value="upcoming" class="text-gray-700">
                                    Próximas
                                </option>
                                <option value="past" class="text-gray-700">
                                    Disfrutadas
                                </option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Reservas -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden"
        >
            <!-- Versión Desktop -->
            <div class="hidden md:block">
                <table
                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider dark:text-orange-500"
                            >
                                Actividad
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider dark:text-orange-500"
                            >
                                Estado
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider dark:text-orange-500"
                            >
                                Fecha
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider dark:text-orange-500"
                            >
                                Hora
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider dark:text-orange-500"
                            >
                                Importe
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider dark:text-orange-500"
                            >
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <tr
                            v-for="reservation in filteredReservations"
                            :key="reservation.id"
                            class="hover:bg-gray-50 transition-colors"
                        >
                            <!-- Actividad -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <!-- <img class="h-10 w-10 rounded-full object-cover" :src="reservation.activity.image ? '/images/activities/' + reservation.activity.image : '/default-activity.jpg'" alt=""> -->
                                    </div>
                                    <!-- <div class="ml-4"> -->
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ reservation.activity.name }}
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </td>

                            <!-- Estado -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    :class="statusClasses(reservation.status)"
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                >
                                    {{
                                        reservation.status
                                            ? "Confirmada"
                                            : "Pendiente"
                                    }}
                                </span>
                            </td>

                            <!-- Fecha -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ formatDate(reservation.activity.date) }}
                                </div>
                            </td>

                            <!-- Hora -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{
                                        formatTime(
                                            reservation.activity.start_time
                                        )
                                    }}
                                    -
                                    {{
                                        formatTime(
                                            reservation.activity.end_time
                                        )
                                    }}
                                </div>
                            </td>

                            <!-- Importe -->
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium"
                            >
                                <span v-if="hasMembership">Miembro</span>
                                <span v-else>{{ reservation.price }} €</span>
                            </td>

                            <!-- Acciones -->
                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                            >
                                <button
                                    @click="openDeleteModal(reservation)"
                                    :disabled="reservation.is_past"
                                    :class="{
                                        'text-red-500 hover:text-red-700':
                                            !reservation.is_past,
                                        'text-gray-400 cursor-not-allowed':
                                            reservation.is_past,
                                    }"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 inline mr-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>
                                    {{
                                        reservation.is_past
                                            ? "No cancelable"
                                            : "Cancelar"
                                    }}
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Versión Mobile -->
            <div class="md:hidden space-y-4 p-4">
                <div
                    v-for="reservation in filteredReservations"
                    :key="reservation.id"
                    class="bg-gray-50 rounded-lg p-4 shadow-sm"
                >
                    <div class="flex justify-between items-start">
                        <div>
                            {{ reservation.name }}
                            <h3 class="font-bold text-gray-800">
                                {{ reservation.activity.name }}
                            </h3>
                            <!-- <p class="text-sm text-gray-600">{{ reservation.activity.location }}</p> -->
                        </div>
                        <span
                            :class="statusClasses(reservation.status)"
                            class="px-2 py-1 text-xs font-semibold rounded-full"
                        >
                            {{
                                reservation.status ? "Confirmada" : "Pendiente"
                            }}
                        </span>
                    </div>

                    <div class="mt-3 grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-xs text-gray-500">Fecha</p>
                            <p class="text-sm font-medium">
                                {{ formatDate(reservation.activity.date) }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Hora</p>
                            <p class="text-sm font-medium">
                                {{
                                    formatTime(reservation.activity.start_time)
                                }}
                                -
                                {{ formatTime(reservation.activity.end_time) }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Importe</p>
                            <p class="text-sm font-medium">
                                {{ reservation.price }} €
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 flex space-x-3">
                        <button
                            @click="openDeleteModal(reservation)"
                            :disabled="reservation.is_past"
                            :class="{
                                'border border-red-500 text-red-500 hover:bg-red-50':
                                    !reservation.is_past,
                                'border border-gray-300 text-gray-400 cursor-not-allowed':
                                    reservation.is_past,
                            }"
                            class="flex-1 text-sm py-2 px-3 rounded-lg flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                />
                            </svg>
                            {{
                                reservation.is_past
                                    ? "No cancelable"
                                    : "Cancelar"
                            }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sin reservas -->
            <div
                v-if="filteredReservations.length === 0"
                class="text-center py-12"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-12 w-12 mx-auto text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                    />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">
                    No tienes reservas
                </h3>
                <p class="mt-1 text-gray-500">
                    Cuando hagas una reserva, aparecerá aquí.
                </p>
            </div>
        </div>

        <!-- Modal de Error -->
        <div v-if="showErrorModal" class="fixed inset-0 z-50 overflow-y-auto">
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <div
                    class="fixed inset-0 transition-opacity"
                    aria-hidden="true"
                >
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                >
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                            >
                                <svg
                                    class="h-6 w-6 text-red-600"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
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
                                    class="text-lg leading-6 font-medium text-gray-900"
                                    id="modal-title"
                                >
                                    No se puede cancelar
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        No puedes cancelar una reserva de una
                                        actividad que ya ha pasado.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                    >
                        <button
                            type="button"
                            @click="closeErrorModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Entendido
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmación -->
        <div v-if="showConfirmModal" class="fixed inset-0 z-50 overflow-y-auto">
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <div
                    class="fixed inset-0 transition-opacity"
                    aria-hidden="true"
                >
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                >
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10"
                            >
                                <svg
                                    class="h-6 w-6 text-orange-600"
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
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Confirmar cancelación
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        ¿Estás seguro de que quieres cancelar la
                                        reserva para
                                        <strong>{{
                                            selectedReservation?.activity?.name
                                        }}</strong>
                                        el
                                        {{
                                            formatDate(
                                                selectedReservation?.activity
                                                    ?.date
                                            )
                                        }}?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                    >
                        <button
                            type="button"
                            @click="confirmDelete"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Sí, cancelar
                        </button>
                        <button
                            type="button"
                            @click="closeConfirmModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            No, mantener
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

// Props
const props = defineProps(["reservations", "hasMembership"]);

// Estado del filtro
const filter = ref("all");

// Estado para los modales
const showErrorModal = ref(false);
const showConfirmModal = ref(false);
const selectedReservation = ref(null);

// Reservas filtradas
const filteredReservations = computed(() => {
    if (filter.value === "all") {
        return props.reservations;
    } else if (filter.value === "upcoming") {
        return props.reservations.filter((r) => !r.is_past);
    } else if (filter.value === "past") {
        return props.reservations.filter((r) => r.is_past);
    }
    return props.reservations;
});

// Formatear fecha
const formatDate = (dateString) => {
    const options = { weekday: "short", day: "numeric", month: "short" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

// Formatear hora
const formatTime = (timeString) => {
    if (!timeString) return "";
    const [hours, minutes] = timeString.split(":");
    return `${hours}h ${minutes}m`;
};

// Clases para el estado
const statusClasses = (status) => {
    return (
        {
            true: "bg-green-100 text-green-800",
            false: "bg-yellow-100 text-yellow-800",
        }[status] || "bg-gray-100 text-gray-800"
    );
};

// Abrir modal de error
const openErrorModal = () => {
    showErrorModal.value = true;
};

// Cerrar modal de error
const closeErrorModal = () => {
    showErrorModal.value = false;
};

// Abrir modal de confirmación
const openDeleteModal = (reservation) => {
    if (reservation.is_past) {
        openErrorModal();
        return;
    }
    selectedReservation.value = reservation;
    showConfirmModal.value = true;
};

// Cerrar modal de confirmación
const closeConfirmModal = () => {
    showConfirmModal.value = false;
    selectedReservation.value = null;
};

// Confirmar eliminación
const confirmDelete = () => {
    if (selectedReservation.value) {
        router.delete(
            route(
                "userActivitiesReservations.destroy",
                selectedReservation.value.id
            )
        );
    }
    closeConfirmModal();
};
</script>

<style scoped>
.transition-colors {
    transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
