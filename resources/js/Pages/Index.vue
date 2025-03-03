<template>
    <div>
        <!-- Navegación -->
        <nav class="p-4 border-b shadow-md bg-white">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">Marina Alta Deportes</div>
                <NavBar />
            </div>
        </nav>

        <!-- Banner Principal -->
        <section class="text-center py-16 bg-gray-100">
            <h1 class="text-4xl font-bold mb-4">
                Descubre los deportes en Marina Alta
            </h1>
            <p class="text-lg mb-6">
                Encuentra actividades, conecta con entrenadores y únete a la
                comunidad deportiva local.
            </p>
            <div class="space-x-4">
                <button
                    class="px-6 py-2 bg-black text-white rounded-lg"
                    @click="login"
                >
                    Empezar
                </button>
                <button
                    class="px-6 py-2 border border-gray-800 rounded-lg"
                    @click="exploreActivities"
                >
                    Explorar actividades
                </button>
            </div>
        </section>

        <!-- Actividades Populares -->
        <section class="py-12 px-4">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Actividades Populares
                </h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <ActivityCard
                        title="Grupos de Running"
                        description="Únete a comunidades de corredores para todos los niveles."
                    />
                    <ActivityCard
                        title="Clases de Natación"
                        description="Instrucción profesional de natación para todas las edades."
                    />
                    <ActivityCard
                        title="Rutas en Bicicleta"
                        description="Explora Marina Alta sobre dos ruedas."
                    />
                </div>
            </div>
        </section>

        <!-- Entrenadores Destacados -->
        <section class="py-12 px-4 bg-gray-100">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Entrenadores Destacados
                </h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8"
                >
                    <TrainerCard
                        name="Alex Martinez"
                        role="Entrenador Personal"
                    />
                    <TrainerCard
                        name="Sara Wilson"
                        role="Instructora de Yoga"
                    />
                    <TrainerCard
                        name="Mark Johnson"
                        role="Entrenador de Natación"
                    />
                    <TrainerCard name="Lisa Chen" role="Experta en Fitness" />
                </div>
            </div>
        </section>

        <!-- Negocios Destacados -->
        <section class="py-12 px-4">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">Negocios Destacados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <BusinessCard
                        name="FitZone Gym"
                        description="Equipamiento de última generación y entrenadores expertos."
                    />
                    <BusinessCard
                        name="Marina Sports Club"
                        description="Instalaciones profesionales de deportes acuáticos y alquiler de equipos."
                    />
                </div>
            </div>
        </section>

        <!-- Pie de Página -->
        <!-- <Footer /> -->
    </div>
</template>

<script setup>
import NavBar from "./Public/Components/NavBar.vue";
// import Footer from "./Public/Components/Footer.vue";
import ActivityCard from "@/Components/ActivityCard.vue";
import TrainerCard from "@/Components/TrainerCard.vue";
import BusinessCard from "@/Components/BusinessCard.vue";

import { router } from "@inertiajs/vue3";

const login = () => {
    router.visit(route("login"));
};
const exploreActivities = () => {
    router.visit(route("activities.index"));
};
</script>

<style scoped>
button {
    transition: all 0.3s;
}
button:hover {
    opacity: 0.8;
}
</style>
