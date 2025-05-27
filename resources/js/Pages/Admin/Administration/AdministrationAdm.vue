<template>
    <div class="container mx-auto p-4">
        <!-- Botón de volver -->
        <button
            @click="() => router.visit(route('admin.index'))"
            class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
            type="button"
        >
            <div
                class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1024 1024"
                    height="25px"
                    width="25px"
                >
                    <path
                        d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                        fill="#000000"
                    ></path>
                    <path
                        d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                        fill="#000000"
                    ></path>
                </svg>
            </div>
            <p class="translate-x-2">Volver</p>
        </button>

        <h1 class="text-2xl font-bold mb-6 dark:text-orange-600">
            Gestión de Gastos e Ingresos
        </h1>

        <!-- Formulario para agregar transacciones -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4 dark:text-orange-700">
                Agregar Nueva Transacción
            </h2>
            <form @submit.prevent="submitTransaction" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Tipo</label
                        >
                        <select
                            v-model="form.type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="income">Ingreso</option>
                            <option value="expense">Gasto</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Monto</label
                        >
                        <input
                            v-model="form.amount"
                            type="number"
                            step="0.01"
                            min="0.01"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Descripción</label
                    >
                    <input
                        v-model="form.description"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Fecha</label
                        >
                        <input
                            v-model="form.date"
                            type="date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Categoría</label
                        >
                        <input
                            v-model="form.category"
                            type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        />
                    </div>
                </div>

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Guardar Transacción
                </button>
            </form>
        </div>

        <!-- Lista de transacciones -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">
                    Historial de Transacciones
                </h2>
                <button
                    @click="exportToCsv"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
                    Exportar a CSV
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Tipo
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Monto
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
                                Categoría
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                            v-for="transaction in transactions"
                            :key="transaction.id"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    :class="{
                                        'text-green-600':
                                            transaction.type === 'income',
                                        'text-red-600':
                                            transaction.type === 'expense',
                                    }"
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                >
                                    {{
                                        transaction.type === "income"
                                            ? "Ingreso"
                                            : "Gasto"
                                    }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ formatCurrency(transaction.amount) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ transaction.description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ formatDate(transaction.date) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ transaction.category }}
                            </td>
                        </tr>
                        <tr v-if="transactions.length === 0">
                            <td
                                colspan="5"
                                class="px-6 py-4 text-center text-gray-500"
                            >
                                No hay transacciones registradas
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({
    layout: AdminLayout,
});

// Props recibidas de Inertia
const props = defineProps({
    transactions: {
        type: Array,
        required: true,
        default: () => [],
    },
});

// Formulario reactivo
const form = reactive({
    type: "income",
    amount: "",
    description: "",
    date: new Date().toISOString().split("T")[0],
    category: "",
});

// Función para enviar el formulario
const submitTransaction = () => {
    router.post(route("admin.transactions.store"), form, {
        preserveScroll: true,
        onSuccess: () => {
            // Resetear el formulario después de enviar
            form.type = "income";
            form.amount = "";
            form.description = "";
            form.date = new Date().toISOString().split("T")[0];
            form.category = "";

            // Mostrar notificación (asumiendo que tienes un sistema de notificaciones)
            // toast.success('Transacción guardada correctamente');
        },
        onError: (errors) => {
            // Mostrar errores (asumiendo que tienes un sistema de notificaciones)
            // toast.error('Error al guardar la transacción');
        },
    });
};

// Función para exportar a CSV
const exportToCsv = () => {
    window.location.href = route("admin.transactions.export");
};

// Funciones de formato
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString("es-ES");
};

const formatCurrency = (amount) => {
    return new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR",
    }).format(amount);
};
</script>

<style scoped>
/* Estilos adicionales si son necesarios */
</style>
