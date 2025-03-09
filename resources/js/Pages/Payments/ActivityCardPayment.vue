<template>
    <div class="payment-container">
        <h1>Pagar Actividad</h1>
        <div v-if="activity">
            <p><strong>Actividad:</strong> {{ activity.name }}</p>
            <p><strong>Precio:</strong> {{ formatPrice(activity.price) }}</p>
            <button @click="handlePayment">Pagar con Stripe</button>
        </div>
        <div v-else>
            <p>Cargando actividad...</p>
        </div>
    </div>
</template>

<script setup>
// Importaciones
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";

const props = defineProps({
    activity: Object,
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
            `/activities/${props.activity.id}/pay`
        );
        window.location.href = response.data.payment_url;
    } catch (error) {
        console.error("Error al procesar el pago:", error);
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
