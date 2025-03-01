<template>
    <div
        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
    >
        <div class="p-6">
            <h1>Carta de la empresa</h1>
            <p>{{ name }}</p>
            <p>{{ description }}</p>
        </div>
    </div>
</template>

<script setup>
// Importaciones

const props = defineProps(["name", "description"]);
</script>
