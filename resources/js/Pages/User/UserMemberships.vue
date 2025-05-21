<template>
    <main class="p-6 min-h-screen dark:bg-gray-900">
        <section class="max-w-6xl mx-auto">
            <!-- Encabezado -->
            <!-- <pre>{{ current_membership }}</pre> -->

            <!-- Tarjetas de membresías -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6 dark:text-orange-600">
                    Planes disponibles
                </h2>

                <!-- Mensaje cuando no hay membresías -->
                <div v-if="!memberships || memberships.length === 0" class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 mb-6">
                    <p class="text-gray-600 dark:text-gray-400">
                        Actualmente no hay planes disponibles. Por favor, inténtalo más tarde.
                    </p>
                </div>

                <div v-else class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="membership in memberships"
                        :key="membership.id"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300"
                        :class="{
                            'ring-2 ring-blue-500':
                                current_membership && current_membership.name === membership.name,
                        }"
                    >
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                    {{ membership.name }}
                                </h3>
                                <div class="flex gap-2">
                                    <span
                                        v-if="membership.name === 'Pro'"
                                        class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium"
                                    >
                                        Popular
                                    </span>
                                    <span
                                        v-if="current_membership && current_membership.name === membership.name"
                                        class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium"
                                    >
                                        Actual
                                    </span>
                                </div>
                            </div>
                            <p class="text-gray-600 mt-2 dark:text-gray-400">
                                {{ membership.description || 'Sin descripción' }}
                            </p>

                            <div class="mt-6">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{
                                        formatPrice(
                                            membership.unit_amount,
                                            membership.currency
                                        )
                                    }}
                                </span>
                                <span class="text-gray-500">
                                    {{ membership.recurring ? "/mes" : "" }}
                                </span>
                            </div>

                            <a
                                v-if="!current_membership || current_membership.name !== membership.name"
                                :href="route('stripe.checkout', membership.name)"
                                class="mt-6 block text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                            >
                                {{
                                    current_membership && current_membership.name
                                        ? "Cambiar plan"
                                        : "Suscribirse"
                                }}
                            </a>
                            <button
                                v-else
                                class="mt-6 w-full bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg cursor-default"
                            >
                                Plan actual
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Información adicional -->
            <section class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">
                    Detalles de tu membresía actual
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Plan actual</p>
                        <p class="font-medium text-gray-800 dark:text-white">
                            {{ current_membership?.name || "Ninguno" }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Próxima renovación</p>
                        <p class="font-medium text-gray-800 dark:text-white">
                            {{ current_membership?.next_payment || "No aplica" }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Estado</p>
                        <p
                            class="font-medium"
                            :class="{
                                'text-green-600 dark:text-green-400': current_membership?.status === 'Activo',
                                'text-red-600 dark:text-red-400': current_membership?.status === 'Inactivo',
                                'text-gray-600 dark:text-gray-300': !current_membership?.status,
                            }"
                        >
                            {{ current_membership?.status || "No suscrito" }}
                        </p>
                    </div>
                    <div v-if="current_membership?.name">
                        <p class="text-gray-500 dark:text-gray-400">Acciones</p>
                        <a
                            href="#"
                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium"
                            @click.prevent="cancelSubscription"
                        >
                            Cancelar suscripción
                        </a>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <!-- Notificaciones -->
    <div
        v-if="showSuccess"
        class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg"
    >
        {{ showSuccess }}
    </div>
    <div
        v-if="showError"
        class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg"
    >
        {{ showError }}
    </div>
</template>

<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineOptions({
    layout: UserLayout,
});

defineProps({
    memberships: {
        type: Array,
        default: () => []
    },
    current_membership: {
        type: Object,
        default: () => ({
            name: null,
            next_payment: null,
            status: null,
        }),
    },
    error: {
        type: String,
        default: null
    }
});

// Función para formatear el precio
const formatPrice = (amount, currency) => {
    if (!amount) return "Precio no disponible";
    const formatter = new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: currency || "USD",
        minimumFractionDigits: 2,
    });
    return formatter.format(amount / 100);
};

const page = usePage();

// Función para cancelar suscripción
const cancelSubscription = () => {
    if (
        confirm(
            "¿Estás seguro de que deseas cancelar tu suscripción?\n\nTu acceso permanecerá activo hasta el final del período actual."
        )
    ) {
        router.post(
            route("stripe.cancel"),
            {},
            {
                onSuccess: () => {
                    // Mostrar notificación de éxito
                    page.props.flash.success = "Suscripción cancelada exitosamente";
                },
                onError: (errors) => {
                    // Mostrar notificación de error
                    page.props.flash.error = errors.message || "Error al cancelar la suscripción";
                },
            }
        );
    }
};

// Mostrar notificaciones
const showSuccess = computed(() => page.props.flash.success);
const showError = computed(() => page.props.flash.error || page.props.error);
</script>