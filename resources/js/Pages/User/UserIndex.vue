<template>
    <div>
        <!-- Barra de Navegación -->
        <nav class="bg-black p-4 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">Bienvenido, {{ user.name }}</h1>
                <UsersNavBar />
            </div>
        </nav>

        <!-- Contenido Principal -->
        <section class="container mx-auto py-12 px-4">
            <h2 class="text-3xl font-semibold text-center mb-6">
                Descubre los eventos que se realizarán en tu zona
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Próximos Eventos</h3>
                    <p class="text-gray-700">
                        Mantente al tanto de las proximas actividades
                        deportivas.
                    </p>
                </div>
                <div v-for="activity in activities" :key="activity.id">
                    <!-- <ActivityCard :activity="activity" /> -->
                    <h3 class="text-xl font-semibold mb-4">
                        {{ activity.name }}
                    </h3>
                    <p class="text-gray-700">
                        {{
                            activity.description.length > 50
                                ? activity.description.substring(0, 50) + "..."
                                : activity.description
                        }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Pie de Página -->
    </div>
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";

// Importaciones de componentes
import UsersNavBar from "./Components/UsersNavBar.vue";

const props = defineProps(["user", "activities"]);
</script>
