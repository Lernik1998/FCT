<template>
    <!-- Navegación -->
    <nav class="p-4 border-b shadow-md bg-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Marina Alta Deportes</div>
            <NavBar />
        </div>
    </nav>

    <div class="ml-20 mt-10">
        <button
            @click="() => router.visit(route('activities.index'))"
            class="bg-gray-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-gray-600 transition"
        >
            Volver
        </button>
    </div>

    <section class="min-h-screen bg-gray-50 flex flex-col items-center p-6">
        <div
            class="max-w-4xl w-full bg-white shadow-lg rounded-lg overflow-hidden animate-fade-in"
        >
            <!-- Imagen de portada -->
            <div class="relative">
                <!-- <img
                    :src="activity.image"
                    alt="Imagen de la actividad"
                    class="w-full h-80 object-cover"
                /> -->
                <div
                    class="absolute inset-0 bg-black bg-opacity-30 flex items-center mt-10"
                >
                    <h1
                        class="text-4xl font-bold drop-shadow-lg ml-5 mb-6 mt-6"
                    >
                        {{ activity.name }}
                    </h1>
                </div>
            </div>

            <!-- Contenido de la actividad -->
            <div class="p-6 space-y-4 mt-10">
                <p class="text-gray-700 text-lg">{{ activity.description }}</p>

                <div class="grid grid-cols-2 gap-4 text-gray-800 text-lg">
                    <p>
                        <strong>Duración:</strong> {{ activity.duration }} min
                    </p>
                    <p><strong>Precio:</strong> {{ activity.price }}€</p>
                    <p><strong>Fecha:</strong> {{ formattedDate }}</p>
                </div>

                <!-- Botón de acción -->
                <div class="mt-6 text-center space-x-4">
                    <button
                        class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-blue-600 transition"
                    >
                        ¡Reserva tu plaza!
                    </button>

                    <button
                        @click="shareActivity"
                        class="bg-green-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-green-600 transition"
                    >
                        ¡Compartir!
                    </button>

                    <button
                        class="bg-yellow-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-yellow-600 transition"
                    >
                        Siguiente actividad
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { ref, defineProps, computed } from "vue";
import { router } from "@inertiajs/vue3";

// Componentes
import NavBar from "../Public/Components/NavBar.vue";

// Recibe la actividad como prop
const props = defineProps({
    activity: Object,
});

// Formatea la fecha en un formato más amigable
const formattedDate = computed(() => {
    const date = new Date(props.activity.date);
    return date.toLocaleDateString("es-ES", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });
});

// Generar enlace para compartir
const shareActivity = () => {
    const url = window.location.href; // Obtiene la URL actual

    if (navigator.share) {
        navigator
            .share({
                title: props.activity.name,
                text: `¡Echa un vistazo a esta actividad: ${props.activity.name}!`,
                url: url,
            })
            .catch(console.error);
    } else {
        navigator.clipboard.writeText(url).then(() => {
            alert("Enlace copiado al portapapeles.");
        });
    }
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
    animation: fade-in 0.5s ease-out;
}
</style>
