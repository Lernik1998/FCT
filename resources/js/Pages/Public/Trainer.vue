<template>
    <div>
        <!-- Banner Principal -->
        <section>
            <div class="relative z-10 text-center p-8">
                <h1 class="text-4xl font-bold mb-4">
                    Encuentra a los Mejores Entrenadores
                </h1>
                <p class="text-lg">
                    Conéctate con expertos en fitness y mejora tu rendimiento.
                </p>
            </div>
        </section>

        <!-- Menú de Navegación -->
        <nav class="p-4">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">Marina Alta Sports</div>
                <NavBar />
            </div>
        </nav>

        <!-- Sección de Entrenadores Destacados -->
        <section class="py-12 px-4 bg-white">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Entrenadores Destacados
                </h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <!-- Se recorren los trainers -->
                    <div
                        v-for="trainer in trainers"
                        :key="trainer.id"
                        class="bg-gray-100 p-6 rounded-lg shadow-lg"
                    >
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">
                            {{ trainer.name }}
                        </h3>

                        <p class="text-gray-700 mb-4">
                            AÑADIR CAMPO DESCRIPCIÓN A USER EN NULLABLE PARA LOS
                            TRAINERS
                        </p>

                        <a
                            :href="route('trainers.show', trainer.id)"
                            class="text-blue-600 hover:underline"
                            >Ver perfil</a
                        >
                    </div>
                </div>
            </div>
        </section>

        <!-- Servicios de Entrenamiento -->
        <section class="py-12 bg-blue-50">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Servicios de Entrenamiento
                </h2>
                <div
                    class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8"
                >
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-4">
                            Personalizado
                        </h3>
                        <p class="text-gray-700">
                            Planes a medida adaptados a tus necesidades.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-4">Online</h3>
                        <p class="text-gray-700">
                            Sesiones virtuales para entrenar desde casa.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-4">Grupal</h3>
                        <p class="text-gray-700">
                            Clases grupales motivacionales y divertidas.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-4">Nutrición</h3>
                        <p class="text-gray-700">
                            Consejos de alimentación para un mejor rendimiento.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pie de Página -->
        <footer class="py-6">
            <div class="container mx-auto text-center">
                <p>&copy; 2025 Trainers Hub. Todos los derechos reservados.</p>
                <div class="mt-4">
                    <a href="#" class="hover:underline">Facebook</a> |
                    <a href="#" class="hover:underline">Twitter</a> |
                    <a href="#" class="hover:underline">Instagram</a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
// Importaciones
import NavBar from "./Components/NavBar.vue";

import { onMounted, watch, defineProps } from "vue";

const props = defineProps(["trainers"]);

watch(
    () => props.trainers,
    (newVal) => {
        console.log("Nuevo valor de trainers:", newVal);
    },
    { immediate: true }
); // Ejecuta el watch inmediatamente con el valor inicial
</script>

<style scoped>
/* Animaciones y estilos adicionales si es necesario */
</style>
