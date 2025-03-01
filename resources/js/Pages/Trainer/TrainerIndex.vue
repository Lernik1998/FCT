<template>
    <div>
        <!-- Banner Principal -->
        <section>
            <div class="relative z-10 text-center">
                <h1 class="text-4xl font-bold mb-4">
                    Gestión de Actividades y Entrenamientos
                </h1>
                <p class="text-lg">
                    Como entrenador, gestiona y publica tus actividades, planes
                    de entrenamiento y posts.
                </p>
            </div>
        </section>

        <button @click="logout">Log Out</button>

        <!-- Menú de Navegación para Trainers -->
        <nav class="p-4">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">Gestión Trainers</div>
                <!-- <TrainersNavBar /> -->
            </div>
        </nav>

        <!-- Sección de Gestión de Actividades -->
        <section class="py-12 px-4 bg-white">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Publicar Actividades
                </h2>
                <form class="space-y-4">
                    <div>
                        <label for="activityName" class="text-lg"
                            >Nombre de la Actividad</label
                        >
                        <input
                            type="text"
                            id="activityName"
                            class="w-full p-3 border rounded-md"
                            placeholder="Ejemplo: Yoga para principiantes"
                        />
                    </div>
                    <div>
                        <label for="activityDescription" class="text-lg"
                            >Descripción</label
                        >
                        <textarea
                            id="activityDescription"
                            class="w-full p-3 border rounded-md"
                            placeholder="Escribe aquí la descripción de la actividad..."
                        ></textarea>
                    </div>
                    <div>
                        <label for="activityDate" class="text-lg"
                            >Fecha y Hora</label
                        >
                        <input
                            type="datetime-local"
                            id="activityDate"
                            class="w-full p-3 border rounded-md"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700"
                    >
                        Publicar Actividad
                    </button>
                </form>
            </div>
        </section>

        <!-- Sección de Gestión de Planes de Entrenamiento -->
        <section class="py-12 px-4 bg-blue-50">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Publicar Plan de Entrenamiento
                </h2>
                <form class="space-y-4">
                    <div>
                        <label for="planTitle" class="text-lg"
                            >Título del Plan</label
                        >
                        <input
                            type="text"
                            id="planTitle"
                            class="w-full p-3 border rounded-md"
                            placeholder="Ejemplo: Plan de entrenamiento para perder peso"
                        />
                    </div>
                    <div>
                        <label for="planDescription" class="text-lg"
                            >Descripción</label
                        >
                        <textarea
                            id="planDescription"
                            class="w-full p-3 border rounded-md"
                            placeholder="Escribe aquí el plan de entrenamiento..."
                        ></textarea>
                    </div>
                    <div>
                        <label for="planDuration" class="text-lg"
                            >Duración (en semanas)</label
                        >
                        <input
                            type="number"
                            id="planDuration"
                            class="w-full p-3 border rounded-md"
                            placeholder="Ejemplo: 6 semanas"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700"
                    >
                        Publicar Plan
                    </button>
                </form>
            </div>
        </section>

        <!-- Sección de Publicación de Posts -->
        <section class="py-12 px-4 bg-white">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">Publicar Post</h2>
                <form class="space-y-4">
                    <div>
                        <label for="postTitle" class="text-lg"
                            >Título del Post</label
                        >
                        <input
                            type="text"
                            id="postTitle"
                            class="w-full p-3 border rounded-md"
                            placeholder="Ejemplo: Cómo mejorar tu flexibilidad"
                        />
                    </div>
                    <div>
                        <label for="postContent" class="text-lg"
                            >Contenido</label
                        >
                        <textarea
                            id="postContent"
                            class="w-full p-3 border rounded-md"
                            placeholder="Escribe aquí el contenido del post..."
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700"
                    >
                        Publicar Post
                    </button>
                </form>
            </div>
        </section>

        <!-- Pie de Página -->
    </div>
</template>

<script setup>
// Importaciones
// import TrainersNavBar from "./Components/TrainersNavBar.vue";

// Importaciones
import { router } from "@inertiajs/vue3";

const logout = () => {
    router.post(route("logout"));
};
</script>

<style scoped>
/* Animaciones y estilos adicionales si es necesario */
</style>
