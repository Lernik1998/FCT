<template>
    <div
        class="min-h-screen bg-gray-100 dark:bg-gray-900"
        :class="{ dark: isDark }"
    >
        <!-- Cabecera -->
        <NavBar />

        <!-- Cuerpo -->
        <main>
            <slot />
        </main>

        <!-- Pie -->
        <Footer />
    </div>
</template>

<script setup>
import NavBar from "@/Pages/Public/Components/NavBar.vue";
import Footer from "@/Pages/Public/Components/Footer.vue";
</script>