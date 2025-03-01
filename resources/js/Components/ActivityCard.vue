<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h1>Carta de la actividad</h1>
            <p>{{ title }}</p>
            <p>{{ description }}</p>
        </div>
    </div>
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";

const props = defineProps(["title", "description"]);
</script>
