<template>
    <section class="max-w-3xl mx-auto text-center">
        <h2 class="text-2xl font-bold mb-4">Actividades de la Semana</h2>
        <div class="relative w-full overflow-hidden">
            <div
                v-for="(slide, index) in slides"
                :key="index"
                class="absolute inset-0 transition-opacity duration-1000"
                :class="{
                    'opacity-100': index === currentSlide,
                    'opacity-0': index !== currentSlide,
                }"
            >
                <img
                    :src="slide.image"
                    :alt="slide.title"
                    class="w-full h-64 object-cover cursor-pointer"
                    @dblclick="redirectToActivity(slide.link)"
                />
                <div
                    class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-4 py-2 rounded"
                >
                    {{ slide.title }}
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-4 space-x-2">
            <span
                v-for="(slide, index) in slides"
                :key="index"
                class="h-3 w-3 rounded-full cursor-pointer"
                :class="index === currentSlide ? 'bg-blue-500' : 'bg-gray-400'"
                @click="currentSlide = index"
            ></span>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from "vue";

const slides = ref([
    {
        image: "/images/activities/activity1.jpg",
        title: "Bicicletas",
        link: "aaaaaaa",
    },
    {
        image: "/images/activities/hipertt.jpeg",
        title: "Nieve",
        link: "/actividad/nieve",
    },
    {
        image: "/imgsPrueba/bicistatic.jpg",
        title: "Montañas",
        link: "/actividad/montanas",
    },
]);

const currentSlide = ref(0);

function nextSlide() {
    currentSlide.value = (currentSlide.value + 1) % slides.value.length;
}

function redirectToActivity(link) {
    window.location.href = link;
}

onMounted(() => {
    setInterval(nextSlide, 2000);
});
</script>
