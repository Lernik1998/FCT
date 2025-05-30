<template>
    <Head title="Error en el pago" />
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Error en el pago</h1>
        <p>
            Ha ocurrido un error al procesar tu pago. Por favor, inténtalo de
            nuevo.
        </p>
        <p>{{ message }}</p>

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

const props = defineProps(["message"]);
</script>
