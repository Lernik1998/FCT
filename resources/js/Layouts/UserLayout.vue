<template>
    <!-- Cabecera -->

    <UsersNavBar />
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
import UsersNavBar from "@/Pages/User/Components/UsersNavBar.vue";
</script>
