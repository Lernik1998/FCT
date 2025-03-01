<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h1>Carta del entrenador</h1>
            <p>{{ name }}</p>
            <p>{{ role }}</p>
        </div>
    </div>
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";

const props = defineProps(["name", "role"]);
</script>
