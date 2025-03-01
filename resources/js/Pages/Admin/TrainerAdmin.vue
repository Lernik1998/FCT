<template>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">
            Gestión de entrenadores
        </h1>

        <!-- Sección de Entrenadores -->
        <section>
            <h2 class="text-2xl font-semibold mb-4">Entrenadores</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="trainer in trainers"
                    :key="trainer.id"
                    class="bg-white shadow-lg rounded-lg p-6 transform transition hover:scale-105"
                >
                    <p class="text-lg font-semibold">{{ trainer.name }}</p>
                    <p class="text-gray-600">{{ trainer.email }}</p>
                    <p class="text-sm text-green-500 font-medium">
                        {{ trainer.role }}
                    </p>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    trainers: Array,
});
</script>
