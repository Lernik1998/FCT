<template>
    <!-- Cabecera -->

    <TrainersNavBar />
    <!-- <head>
        <slot />
    </head> -->

    <!-- Cuerpo -->
    <main>
        <slot />
    </main>

    <!-- Pie -->
</template>

<script setup>
import TrainersNavBar from "@/Pages/Trainer/Components/TrainersNavBar.vue";
</script>
