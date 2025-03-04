<template>
    <h3 class="text-2xl font-bold text-indigo-600 mb-2 text-center">
        {{ props.trainer.name }}
    </h3>
    <h3 class="text-xl text-gray-500 text-center">
        {{ props.trainer.role }}
    </h3>

    <!-- Botón para contactar, PENDIENTE!!!!!! -->
    <a class="text-white bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded"
        >Contactar</a
    >
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";

const props = defineProps(["trainer"]);
</script>
