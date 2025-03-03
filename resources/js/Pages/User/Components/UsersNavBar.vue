<template>
    <div>
        <ul class="flex space-x-6">
            <li>
                <a :href="route('users.index')" class="hover:underline"
                    >Inicio</a
                >
            </li>
            <li>
                <a :href="route('users.stats')" class="hover:underline"
                    >Progreso</a
                >
            </li>
            <li>
                <button @click="logout">Cerrar sesión</button>
            </li>

            <!-- 
            <li>
                <a :href="route('user.reservations')" class="hover:underline"
                    >Gestión de reservas</a
                >
            </li>
            <li>
                <a :href="route('user.messages')" class="hover:underline"
                    >Mensajes</a
                >
            </li> -->
        </ul>
    </div>
</template>

<script setup>
// Importaciones
import { router } from "@inertiajs/vue3";
// Función para cerrar sesión
const logout = () => {
    router.post(route("logout"));
};
</script>

<style scoped></style>
