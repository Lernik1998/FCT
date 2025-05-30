<template>
    <div class="min-h-screen dark:bg-gray-900">
        <!-- Cabecera -->
        <TrainersNavBar />

        <!-- Cuerpo -->
        <main>
            <slot />
        </main>
    </div>
</template>

<script setup>
import TrainersNavBar from "@/Pages/Trainer/Components/TrainersNavBar.vue";
</script>
