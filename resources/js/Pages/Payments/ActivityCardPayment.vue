<template>
    <div class="payment-container bg-white rounded-lg shadow-md p-4">
        <h1 class="text-3xl font-bold mb-4">Pagar Actividad</h1>
        <div v-if="activity" class="grid grid-cols-2 gap-4">
            <p class="text-lg font-semibold">
                <strong>Actividad:</strong> {{ activity.name }}
            </p>
            <p class="text-lg font-semibold">
                <strong>Precio:</strong> {{ formatPrice(activity.price) }}
            </p>
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
    </div>
</template>

<script setup>
// Importaciones
import axios from "axios";

const props = defineProps({
    activity: Object,
    reservation: Object,
});

const formatPrice = (price) => {
    return new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR",
    }).format(price);
};

const handlePayment = async () => {
    try {
        const response = await axios.post(
            route(
                "userActivitiesReservations.payForActivity",
                props.activity.id
            ),
            {
                card_number: props.card_number,
                exp_month: props.exp_month,
                exp_year: props.exp_year,
                cvc: props.cvc,
            }
        );

        if (response.data.payment_url) {
            window.location.href = response.data.payment_url;
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
