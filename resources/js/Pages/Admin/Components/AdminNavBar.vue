<template>
    <nav class="bg-white border-b border-gray-200 shadow-sm px-4 py-3 dark:bg-gray-800 dark:text-white">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo y título -->
            <div class="text-2xl font-bold text-gray-800 dark:text-white">
                Panel de Administración
                <!-- Botón de toggle mejorado -->
                <button
                    @click="themeStore.toggleDarkMode"
                    class="p-2 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700 ml-2"
                    :aria-label="isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
                    :title="isDark ? 'Modo claro' : 'Modo oscuro'"
                >
                    <!-- Icono de toggle -->
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

            <!-- Menú de navegación en dispositivos grandes -->
            <div class="hidden md:flex">
                <ul class="flex items-center space-x-8 py-3 dark:text-white">
                    <!-- Los elementos del menú -->
                    <li>
                        <a :href="route('admin.index')" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 dark:text-gray-300 dark:hover:text-blue-600">
                            Inicio
                        </a>
                    </li>
                    <li class="relative">
                        <a :href="route('admin.informationAdmin')" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center dark:text-gray-300 dark:hover:text-blue-600">
                            Solicitudes
                            <span v-if="numNotifs > 0" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ numNotifs }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a :href="route('admin.messageAdmin')" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 dark:text-gray-300 dark:hover:text-blue-600">
                            Mensajes
                        </a>
                    </li>
                    <li>
                        <Link :href="route('profile.show')" class="hover:underline">
                            Mi cuenta
                        </Link>
                    </li>
                    <li class="ml-auto">
                        <button @click="logout" class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 dark:text-gray-300 dark:hover:text-red-600">
                            Cerrar sesión
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Botón para menú móvil -->
            <div class="md:hidden">
                <button @click="toggleMenu" class="p-2 rounded-full text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Menú móvil -->
    <div v-if="isMenuOpen" class="md:hidden bg-gray-800 text-white py-2">
        <ul class="space-y-4 px-4">
            <li>
                <a :href="route('admin.index')" class="hover:underline">Inicio</a>
            </li>
            <li>
                <a :href="route('admin.informationAdmin')" class="hover:underline">Solicitudes</a>
            </li>
            <li>
                <a :href="route('admin.messageAdmin')" class="hover:underline">Mensajes</a>
            </li>
            <li>
                <Link :href="route('profile.show')" class="hover:underline">Mi cuenta</Link>
            </li>
            <li>
                <button @click="logout" class="text-white">Cerrar sesión</button>
            </li>
        </ul>
    </div>
</template>

<script setup>
// Importaciones
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { useThemeStore } from "../../../../stores/useThemeStore.js";
import { storeToRefs } from "pinia";

// Variables
const props = defineProps(["notifications"]);
const numNotifs = ref(parseInt(props.notifications));

// Función para cerrar sesión
const logout = () => {
    router.post(route("logout"));
};

// Observar cambios en props.notifications
watch(
    () => props.notifications,
    (newNotifications) => {
        numNotifs.value = parseInt(newNotifications);
    }
);

// Variables para el estado del menú móvil
let isMenuOpen = ref(false);
const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

// Obtener el store y sus valores
const themeStore = useThemeStore();
const { isDark } = storeToRefs(themeStore);
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
