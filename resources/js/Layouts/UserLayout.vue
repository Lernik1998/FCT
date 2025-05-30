<template>
    <div class="min-h-screen dark:bg-gray-900">
        <!-- Cabecera -->
        <UsersNavBar />

        <!-- Cuerpo -->
        <main>
            <slot />
        </main>

        <!-- Pie -->
        <Footer />
    </div>
</template>

<script setup>
import UsersNavBar from "@/Pages/User/Components/UsersNavBar.vue";
import Footer from "@/Pages/Public/Components/Footer.vue";
</script>
