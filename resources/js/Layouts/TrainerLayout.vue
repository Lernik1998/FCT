<template>
    <div class="min-h-screen dark:bg-gray-900">
        <!-- :class="{ dark: isDark }" -->
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
    </div>
</template>

<script setup>
import TrainersNavBar from "@/Pages/Trainer/Components/TrainersNavBar.vue";
</script>
