<template>
    <nav class="bg-white border-b border-gray-200 shadow-sm px-4 py-3  dark:bg-gray-800 dark:text-white">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-800 dark:text-white">
                Panel de Administración

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

            <ul class="flex items-center space-x-8 py-3 dark:text-white">
                <!-- Inicio -->
                <li>
                    <a
                        :href="route('admin.index')"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 dark:text-gray-300 dark:hover:text-blue-600"
                        :class="{
                            'text-blue-600 bg-blue-50':
                                route().current('admin.index'),
                        }"
                    >
                        Inicio
                    </a>
                </li>

                <!-- Solicitudes de información -->
                <li class="relative">
                    <a
                        :href="route('admin.informationAdmin')"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center dark:text-gray-300 dark:hover:text-blue-600"
                        :class="{
                            'text-blue-600 bg-blue-50': route().current(
                                'admin.informationAdmin'
                            ),
                        }"
                    >
                        <span>Solicitudes</span>
                        <span
                            v-if="numNotifs > 0"
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"
                        >
                            {{ numNotifs }}
                        </span>
                    </a>
                </li>

                <!-- Mensajes trainers -->
                <li>
                    <a
                        :href="route('admin.messageAdmin')"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 dark:text-gray-300 dark:hover:text-blue-600"
                        :class="{
                            'text-blue-600 bg-blue-50':
                                route().current('admin.messageAdmin'),
                        }"
                    >
                        Mensajes
                    </a>
                </li>

                <li>
                    <Link
                        :href="route('profile.show')"
                        class="hover:underline"
                        :class="{
                            'font-bold text-orange-500 underline':
                                $page.component === 'User/UserProfile',
                        }"
                        >Mi cuenta</Link
                    >
                </li>

                <!-- Cerrar sesión -->
                <li class="ml-auto">
                    <button
                        @click="logout"
                        class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center dark:text-gray-300 dark:hover:text-red-600"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                            />
                        </svg>
                        Cerrar sesión
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script setup>
// Importaciones
import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
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