<template>
    <div>
        <ul class="flex space-x-6">
            <li>
                <a href="#" class="hover:underline">Inicio</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Pagos e ingresos</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Gestión de reservas</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Mensajes</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Planes personalizados</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Posts</a>
            </li>
            <li>
                <button @click="logout">Cerrar sesión</button>
            </li>
        </ul>
    </div>
</template>

<script setup>
// Importaciones
import { router } from "@inertiajs/vue3";

const logout = () => {
    router.post(route("logout"));
};
</script>

<style scoped></style>
