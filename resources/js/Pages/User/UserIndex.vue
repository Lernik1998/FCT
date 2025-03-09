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
            </div>

            <!-- Mensaje de éxito
            <div class="mt-10" v-if="success">
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3"
                    role="alert"
                >
                    {{ success }}
                </div>
            </div> -->

            <div class="mt-10 border-gray-200 border">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border-r">Nombre</th>
                            <th class="p-2 border-r">Descripción</th>
                            <th class="p-2 border-r">Fecha</th>
                            <th class="p-2 border-r">Duración</th>
                            <th class="p-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="activity in activities" :key="activity.id">
                            <td class="p-2 border-r">{{ activity.name }}</td>
                            <td class="p-2 border-r">
                                {{
                                    activity.description.length > 50
                                        ? activity.description.substring(
                                              0,
                                              50
                                          ) + "..."
                                        : activity.description
                                }}
                            </td>
                            <td class="p-2 border-r">{{ activity.date }}</td>
                            <td class="p-2 border-r">
                                {{ activity.duration }} min
                            </td>
                            <td class="p-2 space-x-2">
                                <a
                                    :href="
                                        route(
                                            'activities.showUserActivity',
                                            activity.id
                                        )
                                    "
                                    >Información</a
                                >
                                <a
                                    :href="
                                        route(
                                            'userActivitiesReservations.create',
                                            activity.id
                                        )
                                    "
                                    >Reservar</a
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
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
