<template>
    <nav
        class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg sticky top-0 z-50 dark:bg-gray-800 dark:text-gray-600"
    >
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <!-- <img src="/logo-fitworking.png" alt="FitWorking Logo" class="h-10"> -->
                <h1 class="text-xl font-bold">
                    <!-- ¡Hola, {{ $page.props.user.name }}! -->
                </h1>

                <!-- Botón de toggle mejorado -->
                <button
                    @click="themeStore.toggleDarkMode"
                    class="p-2 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700 ml-2"
                    :aria-label="
                        isDark
                            ? 'Cambiar a modo claro'
                            : 'Cambiar a modo oscuro'
                    "
                    :title="isDark ? 'Modo claro' : 'Modo oscuro'"
                >
                    <transition name="fade" mode="out-in">
                        <svg
                            v-if="isDark"
                            key="sun"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-yellow-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
                            />
                        </svg>
                        <svg
                            v-else
                            key="moon"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-600 dark:text-gray-300"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                            />
                        </svg>
                    </transition>
                </button>

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
                                    'User/ActivityOptions/ActivityReservations',
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
                            >Mensajes X</Link
                        >
                    </li>

                    <li>
                        <Link
                            :href="route('membership.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'User/UserMemberships',
                            }"
                            >Suscripción X</Link
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

import { useThemeStore } from "../../../../stores/useThemeStore.js";
import { storeToRefs } from "pinia";

// Obtener el store y sus valores
const themeStore = useThemeStore();
const { isDark } = storeToRefs(themeStore);

// Función para cerrar sesión
const logout = () => {
    router.post(route("logout"));
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.15s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
