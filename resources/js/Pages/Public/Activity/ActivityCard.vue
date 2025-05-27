<template>
    <div class="p-4 md:p-8 max-w-6xl mx-auto space-y-8">
        <!-- Botón de volver -->
        <button
            @click="() => router.visit(route('activities.index'))"
            class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
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

        <!-- Título -->
        <div class="text-center">
            <h1
                class="text-3xl md:text-5xl font-bold text-gray-800 mb-4 dark:text-white"
            >
                {{ activity.name }}
            </h1>
        </div>

        <!-- Contenedor principal -->
        <section class="bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Imagen -->
            <!-- <div class="w-full aspect-video overflow-hidden">
                <img
                    :src="activity.image"
                    alt="Imagen de la actividad"
                    class="w-full h-full object-cover"
                />
            </div> -->

            <!-- Imagen -->
            <div
                class="w-full h- sm:h-80 md:h-[350px] lg:h-[700px] overflow-hidden"
            >
                <!-- <img
                    :src="
                        'images/activities/' + activity.image ||
                        '/placeholder-actividad.jpg'
                    "
                    alt="Imagen de la actividad"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                /> -->
                <img
                    :src="
                        '/images/activities/' + activity.image ||
                        '/placeholder-actividad.jpg'
                    "
                    :alt="activity.name"
                    class="w-full h-full object-cover"
                />
            </div>

            <!-- Contenido -->
            <div class="p-4 md:p-6 space-y-6">
                <!-- Descripción -->
                <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                    {{ activity.description }}
                </p>

                <!-- Detalles -->
                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-800 text-base md:text-lg"
                >
                    <p><strong>📅 Fecha:</strong> {{ formattedDate }}</p>
                    <p><strong>🕒 Horario:</strong> {{ formattedTime }}</p>
                    <p><strong>Precio:</strong> {{ activity.price }}€</p>
                </div>

                <!-- Botones de acción -->
                <div
                    class="flex flex-col md:flex-row justify-center items-center gap-4 mt-6"
                >
                    <button
                        @click="() => router.visit(route('login'))"
                        class="bg-blue-600 text-white px-5 py-3 rounded-lg font-semibold hover:bg-blue-700 transition w-full md:w-auto"
                    >
                        ¡Reserva tu plaza!
                    </button>

                    <button
                        @click="shareActivity"
                        class="bg-green-600 text-white px-5 py-3 rounded-lg font-semibold hover:bg-green-700 transition w-full md:w-auto"
                    >
                        ¡Compartir!
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
// Importaciones
import { ref, defineProps, computed } from "vue";
import { router } from "@inertiajs/vue3";

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

// Formatea la hora en un formato más amigable
const formattedTime = computed(() => {
    const [startHours, startMinutes] = props.activity.start_time.split(":");
    const [endHours, endMinutes] = props.activity.end_time.split(":");

    const format = (h, m) => `${h.padStart(2, "0")}:${m.padStart(2, "0")}`;

    return `${format(startHours, startMinutes)} - ${format(
        endHours,
        endMinutes
    )}`;
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
