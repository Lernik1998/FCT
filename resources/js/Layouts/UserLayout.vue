<template>
    <div class="min-h-screen dark:bg-gray-900">
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
    </div>
</template>

<script setup>
import UsersNavBar from "@/Pages/User/Components/UsersNavBar.vue";
</script>
