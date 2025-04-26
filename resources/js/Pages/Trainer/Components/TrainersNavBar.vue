<template>
    <nav
        class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg"
    >
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- <img src="/logo-fitworking-white.png" alt="FitWorking Logo" class="h-8"> -->
                <h1 class="text-xl font-bold">Panel de entrenador</h1>
            </div>
            <div>
                <ul class="flex space-x-6">
                    <li>
                        <a
                            :href="route('trainers.index')"
                            class="hover:underline"
                            >Inicio</a
                        >
                    </li>
                    <li>
                        <a
                            :href="route('trainers.payments')"
                            class="hover:underline"
                            >Pagos e ingresos</a
                        >
                    </li>
                    <li>
                        <a href="#" class="hover:underline"
                            >Gestión de reservas</a
                        >
                    </li>
                    <li>
                        <a
                            :href="route('trainers.messages')"
                            class="hover:underline"
                            >Mensajes</a
                        >
                    </li>
                    <li>
                        <a :href="route('trainers.pp')" class="hover:underline"
                            >Actividades</a
                        >
                    </li>
                    <li>
                        <a
                            :href="route('trainers.posts')"
                            class="hover:underline"
                            >Posts</a
                        >
                    </li>
                    <li>
                        <button @click="logout">Cerrar sesión</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
// Importaciones
import { router } from "@inertiajs/vue3";

const logout = () => {
    router.post(route("logout"));
};
</script>