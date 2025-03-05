<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg animate-fade-in">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Crear un Post</h2>

            <!-- Input para el título -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Título</label>
                <input 
                    v-model="titulo" 
                    type="text" 
                    placeholder="Escribe un título..." 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <!-- Área de texto para el contenido -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Contenido</label>
                <textarea 
                    v-model="contenido" 
                    rows="5" 
                    placeholder="Escribe tu post aquí..." 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
            </div>

            <!-- Botón para publicar -->
            <button 
                @click="publicarPost"
                class="w-full bg-blue-500 text-white font-bold py-3 rounded-lg hover:bg-blue-600 transition transform hover:scale-105"
            >
                Publicar
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const titulo = ref("");
const contenido = ref("");

const publicarPost = () => {
    if (!titulo.value.trim() || !contenido.value.trim()) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    console.log("Post creado:", { titulo: titulo.value, contenido: contenido.value });

    // Limpiar los campos después de publicar
    titulo.value = "";
    contenido.value = "";
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
