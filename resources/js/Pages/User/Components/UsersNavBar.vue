<template>
    <nav
        class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg sticky top-0 z-50 dark:bg-gray-800 dark:text-gray-600"
    >
        <div
            class="container mx-auto flex flex-wrap justify-between items-center"
        >
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold hover:scale-105 transition-transform duration-200 dark:text-white">FitWorking</h1>

                <!-- Botón de tema -->
                <button
                    @click="themeStore.toggleDarkMode"
                    class="p-2 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700 ml-2 hover:scale-110"
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
                @click="isMobileMenuOpen = !isMobileMenuOpen"
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
                    isMobileMenuOpen ? 'block' : 'hidden',
                    'md:block',
                ]"
            >
                <ul
                    class="flex flex-col md:flex-row md:items-center md:space-x-6 mt-4 md:mt-0 space-y-2 md:space-y-0"
                >
                    <li>
                        <Link
                            :href="route('users.index')"
                            class="relative group transition duration-300 px-2 py-1 rounded dark:text-white"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component === 'User/UserIndex',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                Inicio
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'User/UserIndex'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('userActivitiesReservations.index')"
                            class="relative group transition duration-300 px-2 py-1 rounded dark:text-white"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component ===
                                    'User/ActivityOptions/ActivityReservations',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                Gestión de reservas
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'User/ActivityOptions/ActivityReservations'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('users.stats')"
                            class="relative group transition duration-300 px-2 py-1 rounded dark:text-white"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component === 'User/UserStats',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                Progreso
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'User/UserStats'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('membership.index')"
                            class="relative group transition duration-300 px-2 py-1 rounded dark:text-white"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component === 'User/UserMemberships',
                            }"
                            prefetch
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                Suscripción
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'User/UserMemberships'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <button 
                            @click="logout" 
                            class="relative group transition duration-300 px-2 py-1 rounded hover:bg-white/10 dark:text-white"
                        >
                            <span class="relative">
                                Cerrar sesión
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { router } from "@inertiajs/vue3";
import { useThemeStore } from "../../../../stores/useThemeStore.js";
import { storeToRefs } from "pinia";

const themeStore = useThemeStore();
const { isDark } = storeToRefs(themeStore);

const isMobileMenuOpen = ref(false);

const logout = () => {
    router.post(route("logout"));
};

// Efecto de parpadeo para la pestaña activa
let intervalId = null;

onMounted(() => {
    // Iniciar el efecto de parpadeo cada 3 segundos
    intervalId = setInterval(() => {
        const activeTabIndicator = document.querySelector('.pulse-animation');
        if (activeTabIndicator) {
            activeTabIndicator.classList.add('animate-pulse');
            setTimeout(() => {
                activeTabIndicator.classList.remove('animate-pulse');
            }, 1000);
        }
    }, 3000);
});

onBeforeUnmount(() => {
    // Limpiar el intervalo cuando el componente se desmonte
    if (intervalId) {
        clearInterval(intervalId);
    }
});
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

/* Animación de subrayado al hover */
.group:hover .group-hover\:w-full {
    width: 100%;
}

/* Animación de pulso para la pestaña activa */
.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
    100% {
        opacity: 1;
    }
}

/* Animación de pulso rápido para el intervalo */
.animate-pulse {
    animation: fastPulse 0.5s;
}

@keyframes fastPulse {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0.3;
    }
    100% {
        opacity: 1;
    }
}

/* Efecto de hover para los enlaces */
.hover\:scale-105:hover {
    transform: scale(1.05);
}

.hover\:scale-110:hover {
    transform: scale(1.1);
}

.transition-transform {
    transition-property: transform;
}

.duration-200 {
    transition-duration: 200ms;
}

/* Efecto para el enlace activo */
.underline-effect-active {
    position: relative;
}

/* Efecto de hover para los botones */
.hover\:bg-white\/10:hover {
    background-color: rgba(255, 255, 255, 0.1);
}
</style>