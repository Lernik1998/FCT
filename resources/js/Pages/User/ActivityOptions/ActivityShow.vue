<template>
    <Head title="Actividad" />

    <!-- Contenido principal -->
    <main class="py-8 px-4 sm:px-6 lg:px-8 dark:bg-gray-900">
        <!-- Botón de volver -->
        <button
            @click="goBack"
            class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group mb-4"
            type="button"
        >
            <div
                class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1024 1024"
                    height="25px"
                    width="25px"
                >
                    <path
                        d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                        fill="#000000"
                    ></path>
                    <path
                        d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                        fill="#000000"
                    ></path>
                </svg>
            </div>
            <p class="translate-x-2">Volver</p>
        </button>

        <div class="max-w-3xl mx-auto">
            <!-- Tarjeta principal -->
            <div class="rounded-xl shadow-lg overflow-hidden animate-fade-in">
                <!-- Imagen destacada -->
                <div class="relative h-64 sm:h-80 w-full overflow-hidden">
                    <img
                        :src="
                            '/images/activities/' + activity.image ||
                            '/default-sport.jpg'
                        "
                        :alt="activity.name"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    />
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4"
                    >
                        <h1
                            class="text-2xl sm:text-3xl font-bold text-white dark:text-orange-600"
                        >
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
                <div class="p-6 sm:p-8 dark:bg-gray-700">
                    <!-- Descripción -->
                    <div class="mb-8">
                        <h2
                            class="text-xl font-bold text-gray-800 mb-4 flex items-center dark:text-white"
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
                        <p
                            class="text-gray-600 leading-relaxed dark:text-white"
                        >
                            {{ activity.description }}
                        </p>
                    </div>

                    <!-- Detalles en grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <!-- Fecha y hora -->
                        <div
                            class="dark:bg-gray-800 p-4 rounded-lg bg-gray-100"
                        >
                            <h3
                                class="font-semibold text-gray-700 mb-2 flex items-center dark:text-white"
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
                            <p class="text-gray-600 dark:text-white">
                                {{ formatDateTime(activity.date) }}
                            </p>
                        </div>

                        <!-- Ubicación -->
                        <div
                            class="dark:bg-gray-800 p-4 rounded-lg bg-gray-100"
                        >
                            <h3
                                class="font-semibold text-gray-700 mb-2 flex items-center dark:text-white"
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
                            <p class="text-gray-600 dark:text-white">
                                {{ activity.location || "Por determinar" }}
                            </p>
                        </div>

                        <div
                            class="dark:bg-gray-800 p-4 rounded-lg bg-gray-100"
                        >
                            <h3
                                class="font-semibold text-gray-700 mb-2 flex items-center dark:text-white"
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
                                <div class="flex space-x-1 dark:text-white">
                                    {{ formatTime(activity.start_time) }} -
                                    {{ formatTime(activity.end_time) }}
                                </div>
                            </div>
                        </div>

                        <div
                            class="dark:bg-gray-800 p-4 rounded-lg bg-gray-100"
                        >
                            <h3
                                class="font-semibold text-gray-700 mb-2 flex items-center dark:text-white"
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
                            <p class="text-gray-600 dark:text-white">
                                {{ activity.slots }} plazas disponibles
                            </p>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div
                        class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4"
                    >
                        <!-- <button
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
                        </button> -->
                        <Link
                            v-if="activity.status === 'active'"
                            :href="
                                route(
                                    'userActivitiesReservations.create',
                                    activity.id
                                )
                            "
                            class="bg-orange-500 dark:bg-orange-600 hover:bg-orange-600 dark:hover:bg-orange-700 text-white py-1 px-3 rounded text-sm text-center transition-colors"
                        >
                            Reservar
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Sección adicional (Recomendaciones) -->
            <div class="mt-10 rounded-xl shadow-lg p-6 dark:bg-gray-700">
                <h2
                    class="text-xl font-bold text-gray-800 mb-4 flex items-center dark:text-white"
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
                <ul class="space-y-3 dark:text-white">
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

// Función para formatear fecha y hora
const formatDateTime = (dateString) => {
    const options = {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric",
    };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

// Formateo hora
const formatTime = (timeString) => {
    const [hours, minutes] = timeString.split(":").map(Number);
    return `${hours.toString().padStart(2, "0")}:${minutes
        .toString()
        .padStart(2, "0")}`;
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
