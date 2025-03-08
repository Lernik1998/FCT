<template>
    <section class="max-w-3xl mx-auto text-center">
        <h2 class="text-2xl font-bold mb-6">Actividades de la Semana</h2>

        <!-- Contenedor del Slider -->
        <div class="relative w-full overflow-hidden h-64">
            <div
                v-for="(slide, index) in slides"
                :key="index"
                class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                :class="{
                    'opacity-100': index === currentSlide,
                    'opacity-0': index !== currentSlide,
                }"
            >
                <img
                    :src="slide.image"
                    :alt="slide.title"
                    class="w-full h-64 object-cover cursor-pointer rounded-2xl"
                    @dblclick="redirectToActivity(slide.link)"
                />
                <div
                    class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-4 py-2 rounded"
                >
                    {{ slide.title }}
                </div>
            </div>

            <!-- Flechas de navegación -->
            <button
                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-gray-700 bg-opacity-50 text-white p-2 rounded-full"
                @click="prevSlide"
            >
                ◀
            </button>
            <button
                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-gray-700 bg-opacity-50 text-white p-2 rounded-full"
                @click="nextSlide"
            >
                ▶
            </button>
        </div>

        <!-- Indicadores (Puntos para cambiar de imagen) -->
        <div class="flex justify-center mt-4 space-x-2">
            <span
                v-for="index in actividadesTotal"
                :key="index"
                class="h-3 w-3 rounded-full cursor-pointer transition-colors"
                :class="index - 1 === actActual ? 'bg-blue-500' : 'bg-gray-400'"
                @click="changeSlide(index - 1)"
            ></span>
        </div>
    </section>
</template>

<script setup>
import { ref, watchEffect, onMounted, onUnmounted } from "vue";

const props = defineProps({
    activities: Array,
});

const slides = ref([]);
const actividadesTotal = props.activities.length;
const actActual = ref(0);
const currentSlide = ref(0);
let interval = null;

// Asegurar que `slides` se cargue correctamente cuando `activities` esté disponible
watchEffect(() => {
    if (props.activities.length > 0) {
        slides.value = props.activities.map((activity) => ({
            image: "/images/activities/" + activity.image,
            title: activity.name,
            link: "/actividad/" + activity.id,
        }));
    }
});

// Función para avanzar el slide automáticamente
function nextSlide() {
    currentSlide.value = (currentSlide.value + 1) % slides.value.length;
    actActual.value = (actActual.value + 1) % actividadesTotal;
}

// Función para retroceder manualmente
function prevSlide() {
    currentSlide.value =
        (currentSlide.value - 1 + slides.value.length) % slides.value.length;
    actActual.value =
        (actActual.value - 1 + actividadesTotal) % actividadesTotal;
}

// Permitir cambiar manualmente al hacer clic en los puntos
function changeSlide(index) {
    currentSlide.value = index;
    actActual.value = index;
}

// Iniciar el slider automático cuando el componente se monta
onMounted(() => {
    interval = setInterval(nextSlide, 3000); // Cambia cada 3 segundos
});

// Limpiar el intervalo cuando el componente se destruye
onUnmounted(() => {
    clearInterval(interval);
});

// Redireccionar a la actividad al hacer doble clic
function redirectToActivity(link) {
    window.location.href = link;
}
</script>

<style scoped></style>
