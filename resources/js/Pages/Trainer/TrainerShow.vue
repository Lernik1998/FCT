<template>
    <div>
        <!-- Barra de Navegación -->
        <nav class="bg-blue-600 p-4 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <NavBar />
            </div>
        </nav>

        <!-- Formulario de Contacto -->
        <section class="container mx-auto py-12 px-4">
            <h2 class="text-3xl font-semibold text-center mb-6">-----</h2>
            <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                {{ props.trainer }}
            </div>
        </section>

        <!-- Pie de Página -->
        <footer class="py-6 bg-gray-800 text-white text-center">
            <p>&copy; 2025 Soporte. Todos los derechos reservados.</p>
        </footer>
    </div>
</template>

<script setup>
// Importaciones
import NavBar from "../Public/Components/NavBar.vue";

import { defineProps } from "vue";

const props = defineProps(["trainer"]);
</script>

<style scoped>
/* Estilos adicionales si es necesario */
</style>
