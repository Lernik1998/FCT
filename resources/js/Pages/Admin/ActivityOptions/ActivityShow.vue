<template>

<Head title="Activdad" />
    <section
        class="bg-gray-100 dark:bg-gray-900 py-6 sm:py-12 px-4 sm:px-6 flex justify-center transition-colors duration-300"
    >
        <div
            class="max-w-2xl w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4 sm:p-8 animate-fade-in transition-colors duration-300"
        >
            <!-- Título -->
            <h1
                class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-orange-600 text-center mb-4 sm:mb-6"
            >
                {{ activity.name }}
            </h1>

            <!-- Información de la Actividad -->
            <div class="space-y-3 sm:space-y-4">
                <!-- Descripción -->
                <div
                    class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg shadow-sm transition-colors duration-300"
                >
                    <h2
                        class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200"
                    >
                        Descripción
                    </h2>
                    <p
                        class="text-gray-600 dark:text-gray-300 mt-1 text-sm sm:text-base"
                    >
                        {{
                            activity.description.length > 50
                                ? activity.description.slice(0, 50) + "..."
                                : activity.description
                        }}
                    </p>
                    <button
                        v-if="activity.description.length > 50"
                        @click="showFullDescription = !showFullDescription"
                        class="text-blue-500 dark:text-blue-400 text-xs sm:text-sm mt-1 hover:underline"
                    >
                        {{ showFullDescription ? "Ver menos" : "Ver más" }}
                    </button>
                    <p
                        v-if="showFullDescription"
                        class="text-gray-600 dark:text-gray-300 mt-1 text-sm sm:text-base"
                    >
                        {{ activity.description }}
                    </p>
                </div>

                <!-- Imagen -->
                <div
                    class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg shadow-sm transition-colors duration-300"
                >
                    <h2
                        class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2"
                    >
                        Imagen
                    </h2>
                    <div class="overflow-hidden rounded-lg">
                        <img
                            v-if="activity.image"
                            :src="`/images/activities/` + activity.image"
                            alt="Imagen de la actividad"
                            class="w-full h-auto max-h-64 sm:max-h-80 object-cover transition-all duration-300 hover:scale-105"
                        />
                        <img
                            v-else
                            :src="'/images/ownImages/default/default.png'"
                            alt="Imagen de la actividad"
                            class="w-full h-auto max-h-64 sm:max-h-80 object-cover transition-all duration-300 hover:scale-105"
                        />
                    </div>
                </div>

                <!-- Detalles en grid para pantallas medianas/grandes -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <!-- Fecha -->
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg shadow-sm transition-colors duration-300"
                    >
                        <h2
                            class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Fecha
                        </h2>
                        <p
                            class="text-gray-600 dark:text-gray-300 mt-1 text-sm sm:text-base"
                        >
                            {{ formatDate(activity.date) }}
                        </p>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg shadow-sm transition-colors duration-300"
                    >
                        <h2
                            class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Horario
                        </h2>
                        <p
                            class="text-gray-600 dark:text-gray-300 mt-1 text-sm sm:text-base"
                        >
                            {{ formatTime(activity.start_time) }} -
                            {{ formatTime(activity.end_time) }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <!-- Fecha -->
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg shadow-sm transition-colors duration-300"
                    >
                        <h2
                            class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Capacidad
                        </h2>
                        <p
                            class="text-gray-600 dark:text-gray-300 mt-1 text-sm sm:text-base"
                        >
                            {{ activity.capacity || "No definida" }}
                        </p>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg shadow-sm transition-colors duration-300"
                    >
                        <h2
                            class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Plazas
                        </h2>
                        <p
                            class="text-gray-600 dark:text-gray-300 mt-1 text-sm sm:text-base"
                        >
                            {{ activity.slots || "No definida" }}
                        </p>
                    </div>
                </div>

                <!-- Estado -->

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <!-- Fecha -->
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg shadow-sm transition-colors duration-300"
                    >
                        <h2
                            class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Estado
                        </h2>
                        <p
                            class="text-gray-600 dark:text-gray-300 mt-1 text-sm sm:text-base"
                        >
                            <span
                                :class="statusClass(activity.status)"
                                class="inline-block mt-1 px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium"
                            >
                                {{
                                    activity.status === "active"
                                        ? "Activo"
                                        : activity.status === "inactive"
                                        ? "Inactivo"
                                        : "Pendiente"
                                }}
                            </span>
                        </p>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg shadow-sm transition-colors duration-300"
                    >
                        <h2
                            class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-200"
                        >
                            Precio
                        </h2>
                        <p
                            class="text-gray-600 dark:text-gray-300 mt-1 text-sm sm:text-base"
                        >
                            {{ activity.price || "No definido" }} €
                        </p>
                    </div>
                </div>

                <!-- Botón de Volver -->
                <div class="text-center mt-4 sm:mt-6">
                    <button
                        @click="goBack"
                        class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                    >
                        <span class="flex items-center justify-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 sm:h-5 sm:w-5 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                />
                            </svg>
                            Volver
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({
    layout: AdminLayout,
});

const showFullDescription = ref(false);

// Recibe la actividad como prop
const props = defineProps({
    activity: Object,
});

// Imagen
const image = "/images/activities/" + props.activity.image;

// Función para formatear la fecha
const formatDate = (date) => {
    return new Date(date).toLocaleDateString("es-ES", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};

// Formatear hora (mostrar solo horas y minutos)
const formatTime = (timeString) => {
    if (!timeString) return ""; // Manejo de casos nulos

    // Dividir la cadena de tiempo y tomar solo horas y minutos
    const [hours, minutes] = timeString.split(":");

    // Formatear como "HH:MM" (por ejemplo "09:30")
    return `${hours}:${minutes}`;

    // O alternativamente como "9h 30m":
    // return `${hours}h ${minutes}m`;
};

// Asignar colores según estado
const statusClass = (status) => {
    return {
        "bg-green-500 dark:bg-green-600 text-white": status === "active",
        "bg-red-500 dark:bg-red-600 text-white": status === "inactive",
        "bg-yellow-500 dark:bg-yellow-600 text-white": status === "pending",
    };
};

// Volver a la página anterior
const goBack = () => {
    window.history.back();
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
