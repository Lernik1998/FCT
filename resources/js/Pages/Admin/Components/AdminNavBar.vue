<template>
    <nav
        class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg sticky top-0 z-50 dark:bg-gray-800 dark:text-gray-600"
    >
        <div
            class="container mx-auto flex flex-wrap justify-between items-center"
        >
            <!-- Logo y título -->
            <div class="flex items-center space-x-4">
                <h1
                    class="text-xl font-bold hover:scale-105 transition-transform duration-200"
                >
                    Panel de Administración
                </h1>

                <!-- Botón de tema -->
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

            <!-- Botón hamburguesa -->
            <button
                @click="toggleMenu"
                class="md:hidden mt-2 text-white focus:outline-none transition-transform duration-200 hover:scale-110"
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
                    />
                </svg>
            </button>

            <!-- Menú de navegación -->
            <div
                :class="[
                    'w-full md:w-auto',
                    isMenuOpen ? 'block' : 'hidden',
                    'md:block',
                ]"
            >
                <ul
                    class="flex flex-col md:flex-row md:items-center md:space-x-6 mt-4 md:mt-0 space-y-2 md:space-y-0"
                >
                    <li>
                        <a
                            :href="route('admin.index')"
                            class="relative group transition duration-300 px-2 py-1 rounded"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component === 'Admin/IndexAdmin',
                            }"
                            @click="isMenuOpen = false"
                        >
                            <span class="relative">
                                Inicio
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Admin/IndexAdmin'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </a>
                    </li>
                    <li class="relative">
                        <a
                            :href="route('admin.informationAdmin')"
                            class="relative group transition duration-300 px-2 py-1 rounded hover:underline flex items-center"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component ===
                                    'Admin/InformationAdmin',
                            }"
                            @click="isMenuOpen = false"
                        >
                            Solicitudes
                            <span
                                v-if="numNotifs > 0"
                                class="ml-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"
                            >
                                {{ numNotifs }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a
                            :href="route('admin.messageAdmin')"
                            class="relative group transition duration-300 px-2 py-1 rounded hover:underline"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component === 'Admin/MessageAdmin',
                            }"
                            @click="isMenuOpen = false"
                        >
                            <span class="relative">
                                Mensajes
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Admin/MessageAdmin'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </a>
                    </li>
                    <li>
                        <Link
                            :href="route('profile.show')"
                            class="relative group transition duration-300 px-2 py-1 rounded hover:underline"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component === 'Profile/Show',
                            }"
                            @click="isMenuOpen = false"
                        >
                            <span class="relative">
                                Mi cuenta
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Profile/Show'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <button
                            @click="logout"
                            class="relative group transition duration-300 px-2 py-1 rounded hover:underline"
                        >
                            Cerrar sesión
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                            ></span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
const isMobileMenuOpen = ref(false);

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
