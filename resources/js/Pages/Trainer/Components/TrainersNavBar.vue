<template>
    <nav
        class="bg-gradient-to-r from-blue-500 to-blue-800 p-4 text-white shadow-lg dark:from-gray-800 dark:to-gray-900 dark:shadow-gray-800/50"
    >
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo y título -->
            <div class="flex items-center space-x-3">
                <h1 class="text-xl font-bold dark:text-gray-100">
                    Panel de entrenador
                </h1>

                <!-- Botón de toggle mejorado -->
                <button
                    @click="themeStore.toggleDarkMode"
                    class="p-2 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 hover:bg-white/20 dark:hover:bg-gray-700 ml-2"
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
                            class="h-5 w-5 text-gray-200"
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

            <!-- Menú de navegación -->
            <div class="hidden md:flex">
                <ul class="flex space-x-6">
                    <li>
                        <Link
                            :href="route('trainers.trainerView')"
                            class="hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Trainer/TrainerIndex',
                            }"
                            >Inicio</Link
                        >
                    </li>
                    <li v-if="$page.props.auth.user.is_active === 1">
                        <Link
                            :href="route('trainers.reservations')"
                            class="hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component ===
                                    'Trainer/TrainerReservations',
                            }"
                            >Reservas</Link
                        >
                    </li>
                    <li v-if="$page.props.auth.user.is_active === 1">
                        <Link
                            :href="route('trainers.messages')"
                            class="hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component ===
                                    'Trainer/TrainerMessages',
                            }"
                            >Mensajes</Link
                        >
                    </li>
                    <li v-if="$page.props.auth.user.is_active === 1">
                        <Link
                            :href="route('trainers.activityCalendar')"
                            class="hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component ===
                                    'Trainer/TrainerActivityCalendar',
                            }"
                            >Actividades</Link
                        >
                    </li>
                    <li v-if="$page.props.auth.user.is_active === 1">
                        <Link
                            :href="route('trainers.posts')"
                            class="hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Trainer/TrainerPosts',
                            }"
                            >Posts</Link
                        >
                    </li>
                    <li>
                        <button
                            @click="logout"
                            class="text-white hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                        >
                            Cerrar sesión
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Botón para abrir el menú en dispositivos móviles -->
            <div class="md:hidden">
                <button
                    @click="isMenuOpen = !isMenuOpen"
                    class="p-2 rounded-full text-white hover:bg-white/20 focus:outline-none transition-colors"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        ></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Menú móvil -->
    <div
        v-show="isMenuOpen"
        class="md:hidden bg-blue-600 dark:bg-gray-800 text-white py-2 transition-all duration-300"
    >
        <ul class="space-y-4 px-4">
            <li>
                <Link
                    :href="route('trainers.trainerView')"
                    class="block hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                    :class="{
                        'font-bold text-orange-500 underline':
                            $page.component === 'Trainer/TrainerIndex',
                    }"
                    @click="isMenuOpen = false"
                    >Inicio</Link
                >
            </li>
            <li v-if="$page.props.auth.user.is_active === 1">
                <Link
                    :href="route('trainers.reservations')"
                    class="block hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                    :class="{
                        'font-bold text-orange-500 underline':
                            $page.component === 'Trainer/TrainerReservations',
                    }"
                    @click="isMenuOpen = false"
                    >Reservas</Link
                >
            </li>
            <li v-if="$page.props.auth.user.is_active === 1">
                <Link
                    :href="route('trainers.messages')"
                    class="block hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                    :class="{
                        'font-bold text-orange-500 underline':
                            $page.component === 'Trainer/TrainerMessages',
                    }"
                    @click="isMenuOpen = false"
                    >Mensajes</Link
                >
            </li>
            <li v-if="$page.props.auth.user.is_active === 1">
                <Link
                    :href="route('trainers.activityCalendar')"
                    class="block hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                    :class="{
                        'font-bold text-orange-500 underline':
                            $page.component ===
                            'Trainer/TrainerActivityCalendar',
                    }"
                    @click="isMenuOpen = false"
                    >Actividades</Link
                >
            </li>
            <li v-if="$page.props.auth.user.is_active === 1">
                <Link
                    :href="route('trainers.posts')"
                    class="block hover:underline hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                    :class="{
                        'font-bold text-orange-500 underline':
                            $page.component === 'Trainer/TrainerPosts',
                    }"
                    @click="isMenuOpen = false"
                    >Posts</Link
                >
            </li>
            <li>
                <button
                    @click="logout"
                    class="text-white hover:text-gray-200 dark:hover:text-gray-300 transition-colors"
                >
                    Cerrar sesión
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
// Importaciones
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { useThemeStore } from "../../../../stores/useThemeStore.js";
import { storeToRefs } from "pinia";

// Obtener el store y sus valores
const themeStore = useThemeStore();
const { isDark } = storeToRefs(themeStore);

// Variable para el menú móvil
const isMenuOpen = ref(false);

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
