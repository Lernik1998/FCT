<template>
    <div
        class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-2xl p-6 space-y-6"
    >
        <h1 class="text-2xl font-bold text-gray-800 border-b pb-2">
            Opciones de pago
        </h1>

        <div class="space-y-2 text-gray-700">
            <p><span class="font-semibold">ID:</span> {{ subscription.id }}</p>
            <p>
                <span class="font-semibold">Estado:</span>
                {{ subscription.status }}
            </p>
            <p>
                <span class="font-semibold">Inicio:</span>
                {{ formatDate(subscription.start_date) }}
            </p>
            <p>
                <span class="font-semibold">Fin del periodo actual:</span>
                {{ formatDate(subscription.current_period_end) }}
            </p>
            <p>
                <span class="font-semibold">Cliente:</span>
                {{ subscription.customer }}
            </p>
            <p>
                <span class="font-semibold">Método de pago:</span>
                {{ subscription.default_payment_method }}
            </p>
        </div>

        <div v-if="subscription.items?.data?.length" class="pt-4 border-t">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Plan</h2>
            <div class="space-y-2 text-gray-700">
                <p>
                    <span class="font-semibold">ID del plan:</span>
                    {{ subscription.items.data[0].plan?.id }}
                </p>
                <p>
                    <span class="font-semibold">Precio:</span>
                    {{
                        formatAmount(
                            subscription.items.data[0].price?.unit_amount,
                            subscription.items.data[0].price?.currency
                        )
                    }}
                </p>
                <p>
                    <span class="font-semibold">Intervalo:</span> Cada
                    {{
                        subscription.items.data[0].price?.recurring
                            ?.interval_count
                    }}
                    {{ subscription.items.data[0].price?.recurring?.interval }}
                </p>
            </div>
        </div>

        <!-- Opciones de cancelación -->
        <div class="pt-6 border-t mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                Opciones de cancelación
            </h2>
            <div
                class="flex items-center justify-between bg-red-50 border border-red-200 rounded-lg p-4"
            >
                <span class="text-gray-700 font-medium"
                    >¿Deseas cancelar la suscripción?</span
                >
                <button
                    @click="cancelSubscription"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition"
                >
                    Cancelar suscripción
                </button>
            </div>
        </div>

        <!-- Opciones de reactivación -->
        <div class="pt-6 border-t mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                Opciones de reactivación
            </h2>
            <div
                class="flex items-center justify-between bg-green-50 border border-green-200 rounded-lg p-4"
            >
                <span class="text-gray-700 font-medium"
                    >¿Deseas reactivar la suscripción?</span
                >
                <button
                    @click="reactivateSubscription"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition"
                >
                    Reactivar suscripción
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
defineOptions({ layout: AdminLayout });

const props = defineProps({
    stripe_id: String,
    subscription: Object,
});

function formatDate(timestamp) {
    if (!timestamp) return "No disponible";
    return new Date(timestamp * 1000).toLocaleString();
}

function formatAmount(amount, currency) {
    if (!amount || !currency) return "No disponible";
    return `${(amount / 100).toFixed(2)} ${currency.toUpperCase()}`;
}

function cancelSubscription() {
    // Lógica para cancelar la suscripción
    console.log("Cancelar suscripción");
    router.post(route("admin.cancelSubscription", props.stripe_id));
}

function reactivateSubscription() {
    // Lógica para reactivar la suscripción
    console.log("Reactivar suscripción");
    router.post(route("admin.reactivateSubscription", props.stripe_id));
}
</script>
