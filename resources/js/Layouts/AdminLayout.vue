<template>
    <!-- <Head title="FitWorking" /> -->

    <!-- Cabecera -->
    <AdminNavBar />

    <!-- Cuerpo -->
    <main>
        <slot />
    </main>

    <!-- Pie -->
</template>

<script setup>
import AdminNavBar from "@/Pages/Admin/Components/AdminNavBar.vue";
</script>
