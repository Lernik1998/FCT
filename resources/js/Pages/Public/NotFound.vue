<template>
    <div
        class="min-h-screen flex flex-col items-center justify-center bg-gray-100 px-4"
    >
        <div
            class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg text-center"
        >
            <h1 class="text-6xl font-bold text-red-500 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                Página no encontrada
            </h2>
            <p class="text-gray-600 mb-6">
                Lo sentimos, la página que estás buscando no existe o ha sido
                movida.
            </p>
            <Link
                href="/"
                class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200"
            >
                Volver al inicio
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<style scoped>
/* Estilos adicionales personalizados */
</style>
