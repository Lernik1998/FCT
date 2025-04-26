<template>
    <section class="mt-28">
        <div class="payment-container bg-white rounded-lg shadow-md p-4">
            <h1 class="text-3xl font-bold mb-4">Pagar Actividad</h1>
            <div v-if="activity" class="grid grid-cols-2 gap-4">
                <p class="text-lg font-semibold">
                    <strong>Actividad:</strong> {{ activity.name }}
                </p>
                <p class="text-lg font-semibold mb-10">
                    <strong>Precio:</strong> {{ formatPrice(activity.price) }}
                </p>

                <!-- Stripe -->
                <div id="card-element"></div>
                <button
                    @click="handlePayment"
                    class="col-span-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Pagar con Stripe
                </button>
            </div>
            <div v-else class="text-center">
                <p class="text-lg">Cargando actividad...</p>
            </div>

            <!-- Paypal -->
            <PaypalButton :activity="activity" :reservation="reservation" />
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { ref, onMounted } from "vue";
import { loadStripe } from "@stripe/stripe-js";
import { router } from "@inertiajs/vue3";

import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

// Componentes
import PaypalButton from "./PaypalButton.vue";

// Stripe
const stripe = ref(null);
const cardElement = ref(null);

// Props
const props = defineProps({
    activity: Object,
    reservation: Object,
});

onMounted(async () => {
    const stripeKey = import.meta.env.VITE_STRIPE_KEY;
    if (!stripeKey) {
        console.error("La clave de Stripe no está definida");
        return;
    }

    stripe.value = await loadStripe(stripeKey);
    if (!stripe.value) {
        console.error("No se pudo cargar Stripe");
        return;
    }

    const elements = stripe.value.elements();
    cardElement.value = elements.create("card", {
        hidePostalCode: true,
    });
    cardElement.value.mount("#card-element");
});

const formatPrice = (price) => {
    return new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR",
    }).format(price);
};

// Envio al controlador
const handlePayment = async () => {
    try {
        if (!stripe.value || !cardElement.value) {
            console.error("Stripe no está correctamente inicializado");
            return;
        }

        const { token, error } = await stripe.value.createToken(
            cardElement.value
        );
        if (error) {
            console.error("Error al crear el token de pago:", error.message);
            alert(error.message);
            return;
        }

        if (confirm("¿Seguro que deseas pagar la actividad?")) {
            router.post(
                route(
                    "userActivitiesReservations.payForActivity",
                    props.activity.id // id de la actividad
                ),
                {
                    stripeToken: token.id, // Token de la tarjeta
                }
            );
        }
    } catch (error) {
        console.error("Error al procesar el pago:", error);
        alert("Hubo un problema al procesar el pago.");
    }
};
</script>

<style scoped>
.payment-container {
    max-width: 500px;
    margin: auto;
    padding: 20px;
    text-align: center;
}
button {
    background-color: #6772e5;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
}
button:hover {
    background-color: #556cd6;
}
</style>