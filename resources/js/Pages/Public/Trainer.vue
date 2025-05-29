<template>
    <Head :title="'Entrenadores'" />

    <!-- Banner Principal -->
    <section
        class="relative w-full h-96 overflow-hidden"
        style="
            background-image: url(/ownImages/tra.webp);
            background-size: cover;
            background-repeat: no-repeat;
        "
    >
        <div
            class="absolute inset-0 flex flex-col items-center justify-center text-center p-8 bg-gradient-to-t from-black/60 to-transparent"
        >
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-orange-500">
                Conoce a nuestro personal
            </h1>
            <p class="text-lg md:text-xl text-white/90">
                Conéctate con expertos en fitness y mejora tu rendimiento.
            </p>
        </div>
    </section>

    <!-- Sección de Entrenadores -->
    <section class="py-12 px-4">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h2
                    class="text-3xl font-bold text-gray-800 mb-4 dark:text-white"
                >
                    Entrenadores
                </h2>
                <p
                    class="text-lg text-gray-600 max-w-2xl mx-auto dark:text-white"
                >
                    Conoce a nuestros profesionales certificados listos para
                    ayudarte a alcanzar tus metas
                </p>
            </div>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8"
            >
                <TrainerCard
                    v-for="trainer in trainers"
                    :key="trainer.id"
                    :trainer="trainer"
                />
            </div>
        </div>
    </section>
</template>

<script setup>
import { watch } from "vue";
import TrainerCard from "./Components/TrainerCard.vue";

const props = defineProps(["trainers"]);

watch(
    () => props.trainers,
    (newVal) => {
        console.log("Nuevo valor de trainers:", newVal);
    },
    { immediate: true }
); // Ejecuta el watch inmediatamente con el valor inicial
</script>
