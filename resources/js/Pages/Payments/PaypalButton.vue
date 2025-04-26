<template>
    <div class="mt-10">
        <div ref="paypalRef"></div>
    </div>
</template>

<script setup>
// Importaciones
import { ref, onMounted } from "vue";
import { loadScript } from "@paypal/paypal-js";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    activity: Object, // Actividad
    reservation: Object, // Reserva
});

const paypalRef = ref(null);

onMounted(async () => {
    try {
        const paypal = await loadScript({
            "client-id": import.meta.env.VITE_PAYPAL_CLIENT_ID,
            currency: "EUR",
        });

        if (paypal) {
            paypal
                .Buttons({
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [
                                {
                                    amount: {
                                        value: props.activity.price.toString(),
                                        currency_code: "EUR",
                                    },
                                },
                            ],
                        });
                    },
                    onApprove: (data, actions) => {
                        return actions.order.capture().then((details) => {
                            // Enviar la información del pago al backend
                            router.post(
                                route(
                                    "userActivitiesReservations.payForActivityWithPaypal",
                                    props.activity.id
                                ),
                                {
                                    paypalToken: data.orderID, // El orderID
                                }
                            );
                            console.log(data);

                            console.log(actions);
                        });
                    },
                    onError: (err) => {
                        console.error("Error en el pago de PayPal:", err);
                    },
                })
                .render(paypalRef.value);
        }
    } catch (error) {
        console.error("Error cargando PayPal SDK:", error);
    }
});
</script>