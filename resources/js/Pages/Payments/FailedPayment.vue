<template>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Error en el pago</h1>
        <p>
            Ha ocurrido un error al procesar tu pago. Por favor, inténtalo de
            nuevo.
        </p>
        <p>{{ message }}</p>
    </div>
</template>

<script setup>
// Importaciones

const props = defineProps(["message"]);
</script>
