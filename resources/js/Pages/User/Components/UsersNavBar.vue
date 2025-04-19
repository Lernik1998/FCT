<template>
    <nav
        class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg sticky top-0 z-50"
    >
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <!-- <img src="/logo-fitworking.png" alt="FitWorking Logo" class="h-10"> -->
                <h1 class="text-xl font-bold">
                    <!-- ¡Hola, {{ $page.props.user.name }}! -->
                </h1>
            </div>
            <div>
                <ul class="flex space-x-6">
                    <li>
                        <Link
                            :href="route('users.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'User/UserIndex',
                            }"
                            >Inicio</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('userActivitiesReservations.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component ===
                                    'User/UserActivitiesReservations',
                            }"
                            >Gestión de reservas</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('users.stats')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'User/UserStats',
                            }"
                            >Progreso</Link
                        >
                    </li>
                    <li>
                        <Link
                            href=""
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'User/UserMessages',
                            }"
                            >Mensajes NO GESTIONADO</Link
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
// Función para cerrar sesión
const logout = () => {
    router.post(route("logout"));
};
</script>

<style scoped></style>
