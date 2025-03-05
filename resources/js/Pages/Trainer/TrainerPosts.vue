<template>
    <!-- Barra navegación del Trainer -->
    <nav class="p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Marina Alta Sports</div>
            <TrainersNavBar />
        </div>
    </nav>

    <div class="min-h-screen bg-gray-100 p-6 flex flex-col items-center">
        <!-- Título y botón de crear post -->
        <div class="flex justify-between items-center w-full max-w-4xl mb-6">
            <h1 class="text-3xl font-bold text-gray-800">📢 Trainer Posts</h1>
            <button
                class="bg-blue-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-600 transition transform hover:scale-105"
                @click="crearNuevoPost"
            >
                + Nuevo Post
            </button>
        </div>

        <!-- Lista de posts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl">
            <div
                v-for="(post, index) in posts"
                :key="index"
                class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 animate-fade-in"
            >
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    {{ post.titulo }}
                </h2>
                <p class="text-gray-600">{{ post.contenido }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
// Importaciones
import { ref } from "vue";

// Componentes
import TrainersNavBar from "./Components/TrainersNavBar.vue";

// Datos simulados de posts
const posts = ref([
    {
        titulo: "Entrenamiento de resistencia",
        contenido: "Descubre cómo mejorar tu resistencia en 30 días.",
    },
    {
        titulo: "Nutrición para atletas",
        contenido: "Alimentos clave para mejorar el rendimiento deportivo.",
    },
    {
        titulo: "Técnicas de recuperación",
        contenido: "Cómo evitar lesiones y mejorar la recuperación muscular.",
    },
]);

// Acción para crear un nuevo post
const crearNuevoPost = () => {
    alert("Función para crear un nuevo post en desarrollo...");
};
</script>

<style scoped>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}
</style>
