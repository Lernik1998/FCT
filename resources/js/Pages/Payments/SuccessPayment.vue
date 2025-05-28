<template>
    <div
        class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-900 transition-colors duration-300"
    >
        <div
            class="max-w-xl w-full mx-auto p-6 sm:p-8 bg-gray-50 dark:bg-gray-800 rounded-2xl shadow-lg"
        >
            <h1
                class="text-3xl sm:text-4xl font-bold text-center text-gray-800 dark:text-orange-500 mb-4"
            >
                Pago realizado con éxito
            </h1>
            <p class="text-center text-gray-600 dark:text-gray-300 mb-6">
                Tu pago ha sido procesado correctamente.
            </p>

            <!-- Imprimir/Guardar enlace (Futura implementación) -->
            <!--
            <div class="text-center mb-6">
                <a
                    :href="`/reservas/${reservation.id}/imprimir`"
                    target="_blank"
                    class="text-blue-600 dark:text-blue-400 hover:underline hover:text-blue-800 dark:hover:text-blue-300 transition"
                >
                    Imprimir/Guardar
                </a>
            </div>
            -->

            <div class="text-center">
                <a
                    :href="route('users.index')"
                    class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-xl shadow-md transition duration-300 ease-in-out"
                >
                    Volver al apartado de actividades
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({
    layout: UserLayout,
});

/* Futura implementación
const reservation = ref(null);

Para activar si usas ID dinámico
onMounted(async () => {
    const response = await axios.get(`/api/reservations/${route.params.id}`);
    reservation.value = response.data.data;
}); */
</script>
