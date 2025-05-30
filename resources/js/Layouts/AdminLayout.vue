<template>
    <div class="min-h-screen dark:bg-gray-900">
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
</script>
