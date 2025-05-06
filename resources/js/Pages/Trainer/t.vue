<template>
    <!-- Contenido principal -->
    <main class="container mx-auto py-8 px-4 sm:px-6">
        <!-- Resumen financiero -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div
                class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500"
            >
                <h3 class="text-gray-500 font-medium mb-2">
                    Ingresos este mes
                </h3>
                <p class="text-3xl font-bold text-gray-800">1,850€</p>
                <p class="text-sm text-green-500 mt-1">...</p>
            </div>

            <div
                class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500"
            >
                <h3 class="text-gray-500 font-medium mb-2">Pagos pendientes</h3>
                <p class="text-3xl font-bold text-gray-800">620€</p>
                <p class="text-sm text-orange-500 mt-1">3 clientes</p>
            </div>

            <div
                class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500"
            >
                <h3 class="text-gray-500 font-medium mb-2">Próximo pago</h3>
                <p class="text-3xl font-bold text-gray-800">1,230€</p>
                <p class="text-sm text-gray-500 mt-1">Disponible en 5 días</p>
            </div>
        </div>

        <!-- Métodos de pago -->
        <!-- <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                Distribución por Método de Pago
            </h2>
            <div class="h-80 flex items-center">
                <div class="text-center w-64">
                    <div class="relative mx-auto w-48 h-48 mb-4">
                     
                        <div
                            class="absolute inset-0 rounded-full border-8 border-orange-300"
                        ></div>
                        <div
                            class="absolute inset-0 rounded-full border-8 border-blue-300"
                            style="
                                clip-path: polygon(
                                    0 0,
                                    100% 0,
                                    100% 50%,
                                    0 50%
                                );
                            "
                        ></div>
                        <div
                            class="absolute inset-0 rounded-full border-8 border-green-300"
                            style="
                                clip-path: polygon(
                                    0 50%,
                                    100% 50%,
                                    100% 100%,
                                    0 100%
                                );
                            "
                        ></div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <div
                                class="w-3 h-3 bg-orange-500 rounded-full mr-2"
                            ></div>
                            <span>Transferencia (60%)</span>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-3 h-3 bg-blue-500 rounded-full mr-2"
                            ></div>
                            <span>Tarjeta (25%)</span>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-3 h-3 bg-green-500 rounded-full mr-2"
                            ></div>
                            <span>Efectivo (15%)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Funcionalidades para entrenadores -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Solicitar pago -->
            <div
                class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow mt-32"
            >
                <div
                    class="bg-orange-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-orange-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Solicitar Pago
                </h3>
                <p class="text-gray-600 mb-4">
                    Envía solicitudes de pago a tus clientes por servicios
                    realizados.
                </p>
                <button
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg transition-colors"
                >
                    Crear Solicitud
                </button>
            </div>

            <!-- Configurar disponibilidad -->
            <div
                class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow mt-32"
            >
                <div
                    class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                        />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Configurar Disponibilidad
                </h3>
                <p class="text-gray-600 mb-4">
                    Establece tus horarios y tarifas para nuevas sesiones.
                </p>
                <button
                    class="w-full border border-blue-500 text-blue-500 hover:bg-blue-50 py-2 px-4 rounded-lg transition-colors"
                >
                    Gestionar Horarios
                </button>
            </div>

            <!-- Historial de pagos -->
            <div
                class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow mt-32"
            >
                <div
                    class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500"
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
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Historial Completo
                </h3>
                <p class="text-gray-600 mb-4">
                    Consulta todos tus pagos recibidos y pendientes.
                </p>
                <button
                    class="w-full border border-green-500 text-green-500 hover:bg-green-50 py-2 px-4 rounded-lg transition-colors"
                >
                    Ver Historial
                </button>
            </div>
        </div>
    </main>
</template>

<script setup>
import PaymentsChart from "./Components/PaymentsChart.vue";
import TrainerLayout from "@/Layouts/TrainerLayout.vue";

defineOptions({
    layout: TrainerLayout,
});
</script>

<style scoped>
.transition-colors {
    transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
