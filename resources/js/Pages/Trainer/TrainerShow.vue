<template>
    <!-- Menú de Navegación -->
    <nav class="p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Marina Alta Sports</div>
            <NavBar />
        </div>
    </nav>

    <div>
        <!-- Formulario de Contacto -->
        <section class="container mx-auto py-12 px-4">
            <h2 class="text-3xl font-semibold text-center mb-6">Perfil</h2>
            <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                <TrainerCard :trainer="props.trainer" />
            </div>
        </section>

        <!-- Planes personalizados del Trainer -->
        <section>
            <h2 class="text-3xl font-semibold text-center mb-6">
                Planes personalizados
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="plan in props.plans"
                    class="bg-white p-6 rounded-lg shadow-lg"
                >
                    <h3 class="text-xl font-semibold mb-2">
                        {{ plan.name }}
                    </h3>
                    <p class="text-gray-600">{{ plan.description }}</p>
                    <p class="text-sm text-green-500 font-medium">
                        {{ plan.price }}
                    </p>
                </div>
            </div>
        </section>
    </div>

    <!-- Pie de Página -->
</template>

<script setup>
// Importaciones
import NavBar from "../Public/Components/NavBar.vue";
import TrainerCard from "@/Pages/Trainer/Components/TrainerCard.vue";

import { defineProps } from "vue";

const props = defineProps(["trainer", "plans"]);
</script>

<style scoped>
/* Estilos adicionales si es necesario */
</style>
