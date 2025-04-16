<template>
    <p>Public Layout</p>

    <Head title="FitWorking" />

    <!-- Cabecera -->
    <NavBar />

    <!-- Cuerpo -->
    <main>
        <slot />
    </main>

    <!-- Pie -->
    <Footer />
</template>

<script setup>
import NavBar from "@/Pages/Public/Components/NavBar.vue";
import Footer from "@/Pages/Public/Components/Footer.vue";
</script>
