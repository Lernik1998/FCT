<template>
    <!-- Barra de navegación mejorada -->
    <nav class="p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <button
                    @click="goBack"
                    class="p-2 rounded-full hover:bg-orange-600 transition-colors"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>
                </button>
                <h1 class="font-bold">Actividades</h1>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Tarjeta principal -->
            <div class="rounded-xl shadow-lg overflow-hidden animate-fade-in">
                <!-- Imagen destacada -->
                <div class="relative h-64 sm:h-80 w-full overflow-hidden">
                    <img
                        :src="image"
                        :alt="activity.name"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    />
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4"
                    >
                        <h1 class="text-2xl sm:text-3xl font-bold text-white">
                            {{ activity.name }}
                        </h1>
                        <div class="flex items-center mt-2">
                            <span
                                :class="statusClass(activity.status)"
                                class="px-3 py-1 rounded-full text-sm font-medium"
                            >
                                {{
                                    activity.status === "active"
                                        ? "Disponible"
                                        : activity.status === "inactive"
                                        ? "Completo"
                                        : "Próximamente"
                                }}
                            </span>
                            <span
                                class="ml-3 text-white text-sm flex items-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 mr-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                {{ duration }} minutos
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contenido informativo -->
                <div class="p-6 sm:p-8">
                    <!-- Descripción -->
                    <div class="mb-8">
                        <h2
                            class="text-xl font-bold text-gray-800 mb-4 flex items-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2 text-orange-500"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Sobre esta actividad
                        </h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ activity.description }}
                        </p>
                    </div>

                    <!-- Detalles en grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <!-- Fecha y hora -->
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <h3
                                class="font-semibold text-gray-700 mb-2 flex items-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-2 text-orange-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                                Fecha y hora
                            </h3>
                            <p class="text-gray-600">
                                {{ formatDateTime(activity.date) }}
                            </p>
                        </div>

                        <!-- Ubicación -->
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <h3
                                class="font-semibold text-gray-700 mb-2 flex items-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-2 text-orange-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                                Ubicación
                            </h3>
                            <p class="text-gray-600">
                                {{ activity.location || "Por determinar" }}
                            </p>
                        </div>

                        <div class="bg-orange-50 p-4 rounded-lg">
                            <h3
                                class="font-semibold text-gray-700 mb-2 flex items-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-2 text-orange-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"
                                    />
                                </svg>
                                Hora
                            </h3>
                            <div class="flex items-center">
                                <div class="flex space-x-1">
                                    {{ activity.start_time }} -
                                    {{ activity.end_time }}
                                </div>
                            </div>
                        </div>

                        <div class="bg-orange-50 p-4 rounded-lg">
                            <h3
                                class="font-semibold text-gray-700 mb-2 flex items-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-2 text-orange-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                                Plazas
                            </h3>
                            <p class="text-gray-600">
                                {{ activity.slots }} plazas disponibles
                            </p>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div
                        class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4"
                    >
                        <button
                            v-if="activity.status === 'active'"
                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-md flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                />
                            </svg>
                            Reservar ahora
                        </button>
                        <button
                            v-else
                            class="flex-1 bg-gray-300 text-gray-600 font-bold py-3 px-6 rounded-lg cursor-not-allowed flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                />
                            </svg>
                            No disponible
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sección adicional (Recomendaciones) -->
            <div class="mt-10 bg-white rounded-xl shadow-lg p-6">
                <h2
                    class="text-xl font-bold text-gray-800 mb-4 flex items-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2 text-orange-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                        />
                    </svg>
                    Recomendaciones
                </h2>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-orange-500 mr-2 mt-0.5 flex-shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        Llega 10 minutos antes para el registro
                    </li>
                    <li class="flex items-start">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-orange-500 mr-2 mt-0.5 flex-shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        Usa ropa deportiva cómoda
                    </li>
                    <li class="flex items-start">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-orange-500 mr-2 mt-0.5 flex-shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        Trae una botella de agua
                    </li>
                    <li class="flex items-start">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-orange-500 mr-2 mt-0.5 flex-shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        No olvides tu toalla
                    </li>
                </ul>
            </div>
        </div>
    </main>
</template>

<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { onMounted } from "vue";
import { ref } from "vue";

const duration = ref(0);

defineOptions({
    layout: UserLayout,
});

// Recibe la actividad como prop
const props = defineProps({
    activity: Object,
});

// Imagen
const image =
    "/images/activities/" + props.activity.image || "/default-activity.jpg";

// Función para formatear fecha y hora
const formatDateTime = (dateString) => {
    const options = {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

// Asignar colores según estado
const statusClass = (status) => {
    return (
        {
            active: "bg-green-500 text-white",
            inactive: "bg-red-500 text-white",
            pending: "bg-yellow-500 text-white",
        }[status] || "bg-gray-300 text-gray-800"
    );
};

// Volver a la página anterior
const goBack = () => {
    window.history.back();
};

onMounted(() => {
    // Función para convertir tiempo HH:MM:SS a minutos totales
    const timeToMinutes = (timeStr) => {
        const [hours, minutes] = timeStr.split(":").map(Number);
        return hours * 60 + minutes;
    };

    const startMinutes = timeToMinutes(props.activity.start_time);
    const endMinutes = timeToMinutes(props.activity.end_time);

    duration.value = endMinutes - startMinutes;
});
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

.transition-colors {
    transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
