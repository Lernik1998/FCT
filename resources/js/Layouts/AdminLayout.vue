<template>
    <!-- <Head title="FitWorking" /> -->

    <div class="min-h-screen dark:bg-gray-900">
        <!-- :class="{ dark: isDark }" -->
        <!-- Cabecera -->
        <AdminNavBar />

        <!-- Cuerpo -->
        <main>
            <slot />
        </main>
    </div>
    <!-- Pie -->
</template>

<script setup>
import AdminNavBar from "@/Pages/Admin/Components/AdminNavBar.vue";
// import { useThemeStore } from "@/stores/useThemeStore.js";
// import { storeToRefs } from "pinia";

// Obtener el store y sus valores
// const themeStore = useThemeStore();
// const { isDark } = storeToRefs(themeStore);
</script>
