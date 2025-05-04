<template>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Pago realizado con éxito</h1>
        <p>
            Tu pago ha sido procesado correctamente. Puedes imprimir o guardar
            tu reserva en el siguiente enlace:
        </p>
        <!-- <a
            :href="`/reservas/${reservation.id}/imprimir`"
            target="_blank"
            class="text-blue-500 hover:text-blue-700"
        >
            Imprimir/Guardar
        </a> -->

        <!-- Botoón volver a la página de inicio -->
        <a
            :href="route('users.index')"
            class="inline-block bg-orange-500 text-white py-2 px-4 rounded mt-4"
            >Volver a la página de inicio</a
        >
    </div>
</template>

<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({
    layout: UserLayout,
});

import { ref, onMounted } from "vue";

const reservation = ref(null);

// const props = defineProps(['']);

// onMounted(async () => {
//     const response = await axios.get(`/api/reservations/${route.params.id}`);
//     reservation.value = response.data.data;
// });
</script>
