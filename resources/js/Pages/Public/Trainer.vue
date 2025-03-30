<template>
    <div>
        <!-- Menú de Navegación -->
        <nav class="p-4">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">FitWorking</div>
                <NavBar />
            </div>
        </nav>

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
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">
                    Conoce a nuestro personal
                </h1>
                <p class="text-lg md:text-xl text-white/90">
                    Conéctate con expertos en fitness y mejora tu rendimiento.
                </p>
            </div>
        </section>

        <!-- Sección de Entrenadores -->
        <!-- <section class="py-12 px-4 bg-white">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">Entrenadores</h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    Se recorren los trainers 
                    <div
                        v-for="trainer in trainers"
                        :key="trainer.id"
                        class="bg-gray-100 p-6 rounded-lg shadow-lg"
                    >
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">
                            {{ trainer.name }}
                        </h3>

                        <p class="text-gray-700 mb-4">
                            AÑADIR CAMPO DESCRIPCIÓN A USER EN NULLABLE PARA LOS
                            TRAINERS
                        </p>

                        <a
                            :href="route('trainers.show', trainer.id)"
                            class="text-blue-600 hover:underline"
                            >Ver perfil</a
                        >
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Sección de Entrenadores -->
        <section class="py-12 px-4 bg-gray-50">
            <div class="container mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        Entrenadores
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
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

        <!-- Servicios de Entrenamiento -->
        <!-- <section class="py-12 bg-gray-200">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Servicios de Entrenamiento
                </h2>
                <div
                    class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8"
                >
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-4">
                            Personalizado
                        </h3>
                        <p class="text-gray-700">
                            Planes a medida adaptados a tus necesidades.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-4">Online</h3>
                        <p class="text-gray-700">
                            Sesiones virtuales para entrenar desde casa.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-4">Grupal</h3>
                        <p class="text-gray-700">
                            Clases grupales motivacionales y divertidas.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-4">Nutrición</h3>
                        <p class="text-gray-700">
                            Consejos de alimentación para un mejor rendimiento.
                        </p>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Pie de Página -->
        <Footer />
    </div>
</template>

<script setup>
// Importaciones
import { watch } from "vue";

// Componentes
import NavBar from "./Components/NavBar.vue";
import TrainerCard from "./Components/TrainerCard.vue";
import Footer from "./Components/Footer.vue";

const props = defineProps(["trainers"]);

watch(
    () => props.trainers,
    (newVal) => {
        console.log("Nuevo valor de trainers:", newVal);
    },
    { immediate: true }
); // Ejecuta el watch inmediatamente con el valor inicial
</script>

<style scoped></style>
