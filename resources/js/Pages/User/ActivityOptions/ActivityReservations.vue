<template>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
        <!-- Barra de Navegación Mejorada -->
        <nav
            class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg"
        >
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <!-- <img src="/logo-fitworking-white.png" alt="FitWorking Logo" class="h-8"> -->
                    <h1 class="text-xl font-bold">Mis Reservas</h1>
                </div>
                <UsersNavBar />
            </div>
        </nav>

        <!-- Contenido Principal -->
        <main class="container mx-auto py-8 px-4 sm:px-6">
            <!-- Encabezado -->
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8"
            >
                <div>
                    <h1
                        class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 mr-3 text-orange-500"
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
                        Tus reservas activas
                    </h1>
                    <p class="text-gray-600 mt-2">
                        Revisa y gestiona todas tus actividades reservadas
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <select
                        class="bg-white border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                    >
                        <option>Filtrar por estado</option>
                        <option>Todas</option>
                        <option>Confirmadas</option>
                        <option>Pendientes</option>
                        <option>Canceladas</option>
                    </select>
                </div>
            </div>

            <!-- Lista de Reservas -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Versión Desktop -->
                <div class="hidden md:block">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Actividad
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Estado
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Fecha
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Importe
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="reservation in reservations"
                                :key="reservation.id"
                                class="hover:bg-gray-50 transition-colors"
                            >
                                <!-- Actividad -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <!-- <img class="h-10 w-10 rounded-full object-cover" :src="reservation.activity.image ? '/images/activities/' + reservation.activity.image : '/default-activity.jpg'" alt=""> -->
                                        </div>
                                        <div class="ml-4">
                                            <!-- <div class="text-sm font-medium text-gray-900">{{ reservation.activity.name }}</div> -->
                                            <!-- <div class="text-sm text-gray-500">{{ reservation.activity.location }}</div> -->
                                        </div>
                                    </div>
                                </td>

                                <!-- Estado -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        :class="
                                            statusClasses(reservation.status)
                                        "
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
                                    <!-- <div class="text-sm text-gray-900">{{ formatDate(reservation.activity.date) }}</div> -->
                                    <!-- <div class="text-sm text-gray-500">{{ reservation.activity.time }}</div> -->
                                </td>

                                <!-- Importe -->
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium"
                                >
                                    {{ reservation.price }} €
                                </td>

                                <!-- Acciones -->
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <button
                                        @click="
                                            showPayForReservation(
                                                reservation.id
                                            )
                                        "
                                        class="text-orange-500 hover:text-orange-700 mr-4"
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
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                            />
                                        </svg>
                                        Pagar
                                    </button>
                                    <button
                                        @click="
                                            deleteReservation(reservation.id)
                                        "
                                        class="text-red-500 hover:text-red-700"
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
                                        Cancelar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Versión Mobile -->
                <div class="md:hidden space-y-4 p-4">
                    <div
                        v-for="reservation in reservations"
                        :key="reservation.id"
                        class="bg-gray-50 rounded-lg p-4 shadow-sm"
                    >
                        <div class="flex justify-between items-start">
                            <div>
                                <!-- <h3 class="font-bold text-gray-800">{{ reservation.activity.name }}</h3> -->
                                <!-- <p class="text-sm text-gray-600">{{ reservation.activity.location }}</p> -->
                            </div>
                            <span
                                :class="statusClasses(reservation.status)"
                                class="px-2 py-1 text-xs font-semibold rounded-full"
                            >
                                {{
                                    reservation.status
                                        ? "Confirmada"
                                        : "Pendiente"
                                }}
                            </span>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs text-gray-500">Fecha</p>
                                <!-- <p class="text-sm font-medium">{{ formatDate(reservation.activity.date) }}</p> -->
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Hora</p>
                                <!-- <p class="text-sm font-medium">{{ reservation.activity.time }}</p> -->
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
                                @click="showPayForReservation(reservation.id)"
                                class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-sm py-2 px-3 rounded-lg flex items-center justify-center"
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
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                    />
                                </svg>
                                Pagar
                            </button>
                            <button
                                @click="deleteReservation(reservation.id)"
                                class="flex-1 border border-red-500 text-red-500 hover:bg-red-50 text-sm py-2 px-3 rounded-lg flex items-center justify-center"
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
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sin reservas -->
                <div v-if="reservations.length === 0" class="text-center py-12">
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
                    <div class="mt-6">
                        <a
                            href="#"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="-ml-1 mr-2 h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                />
                            </svg>
                            Buscar actividades
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
// Componentes
import UsersNavBar from "../Components/UsersNavBar.vue";

// Importaciones
import { router } from "@inertiajs/vue3";

// Props
const props = defineProps(["reservations"]);

// Formatear fecha
const formatDate = (dateString) => {
    const options = { weekday: "short", day: "numeric", month: "short" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
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

// Eliminar reserva
const deleteReservation = (id) => {
    if (confirm("¿Estás seguro de que quieres cancelar esta reserva?")) {
        router.delete(route("userActivitiesReservations.destroy", id));
    }
};

// Mostrar pago
const showPayForReservation = (id) => {
    router.get(route("userActivitiesReservations.showPayForActivity", id));
};
</script>

<style scoped>
.transition-colors {
    transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
