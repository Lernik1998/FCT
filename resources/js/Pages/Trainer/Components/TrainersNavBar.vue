<template>
    <nav
        class="bg-gradient-to-r from-blue-500 to-blue-800 p-4 text-white shadow-lg dark:from-gray-800 dark:to-gray-900 dark:shadow-gray-800/50"
    >
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo y título -->
            <div class="flex items-center space-x-3">
                <h1
                    class="text-xl font-bold dark:text-gray-100 hover:scale-105 transition-transform duration-200"
                >
                    Panel de entrenador
                </h1>

                <!-- Botón de toggle mejorado -->
                <button
                    @click="themeStore.toggleDarkMode"
                    class="p-2 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 hover:bg-white/20 dark:hover:bg-gray-700 ml-2 hover:scale-110"
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
                            class="relative group transition duration-300 px-2 py-1 rounded"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component === 'Trainer/TrainerIndex',
                            }"
                            >Inicio
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                            ></span>
                            <span
                                v-if="
                                    $page.component === 'Trainer/TrainerIndex'
                                "
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li v-if="$page.props.auth.user.is_active === 1">
                        <Link
                            :href="route('trainers.reservations')"
                            class="relative group transition duration-300 px-2 py-1 rounded"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component ===
                                    'Trainer/TrainerReservations',
                            }"
                            >Reservas
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                            ></span>
                            <span
                                v-if="
                                    $page.component ===
                                    'Trainer/TrainerReservations'
                                "
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li v-if="$page.props.auth.user.is_active === 1">
                        <Link
                            :href="route('trainers.messages')"
                            class="relative group transition duration-300 px-2 py-1 rounded"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component ===
                                    'Trainer/TrainerMessages',
                            }"
                            >Mensajes
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                            ></span>
                            <span
                                v-if="
                                    $page.component ===
                                    'Trainer/TrainerMessages'
                                "
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li v-if="$page.props.auth.user.is_active === 1">
                        <Link
                            :href="route('trainers.activityCalendar')"
                            class="relative group transition duration-300 px-2 py-1 rounded"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component ===
                                    'Trainer/TrainerActivityCalendar',
                            }"
                            >Actividades
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                            ></span>
                            <span
                                v-if="
                                    $page.component ===
                                    'Trainer/TrainerActivityCalendar'
                                "
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li v-if="$page.props.auth.user.is_active === 1">
                        <Link
                            :href="route('trainers.posts')"
                            class="relative group transition duration-300 px-2 py-1 rounded"
                            :class="{
                                'font-bold bg-white/20 underline-effect-active':
                                    $page.component === 'Trainer/TrainerPosts',
                            }"
                            >Posts
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                            ></span>
                            <span
                                v-if="
                                    $page.component === 'Trainer/TrainerPosts'
                                "
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <button
                            @click="logout"
                            class="relative group transition duration-300 px-2 rounded hover:bg-white/10 w-full"
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

            <!-- Botón para abrir el menú en dispositivos móviles -->
            <div class="md:hidden">
                <button
                    @click="isMenuOpen = !isMenuOpen"
                    class="p-2 rounded-full text-white hover:bg-white/20 focus:outline-none transition-colors hover:scale-110 duration-200"
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
                    class="block relative group transition duration-300 px-2 py-1 rounded"
                    :class="{
                        'font-bold bg-white/20 underline-effect-active':
                            $page.component === 'Trainer/TrainerIndex',
                    }"
                    @click="isMenuOpen = false"
                    ><span class="relative">
                        Inicio
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                        ></span>
                    </span>
                    <span
                        v-if="$page.component === 'Trainer/TrainerIndex'"
                        class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                    ></span>
                </Link>
            </li>
            <li v-if="$page.props.auth.user.is_active === 1">
                <Link
                    :href="route('trainers.reservations')"
                    class="block relative group transition duration-300 px-2 py-1 rounded"
                    :class="{
                        'font-bold bg-white/20 underline-effect-active':
                            $page.component === 'Trainer/TrainerReservations',
                    }"
                    @click="isMenuOpen = false"
                    ><span class="relative">
                        Reservas
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                        ></span>
                    </span>
                    <span
                        v-if="$page.component === 'Trainer/TrainerReservations'"
                        class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                    ></span>
                </Link>
            </li>
            <li v-if="$page.props.auth.user.is_active === 1">
                <Link
                    :href="route('trainers.messages')"
                    class="block relative group transition duration-300 px-2 py-1 rounded"
                    :class="{
                        'font-bold bg-white/20 underline-effect-active':
                            $page.component === 'Trainer/TrainerMessages',
                    }"
                    @click="isMenuOpen = false"
                    ><span class="relative">
                        Mensajes
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                        ></span>
                    </span>
                    <span
                        v-if="$page.component === 'Trainer/TrainerMessages'"
                        class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                    ></span>
                </Link>
            </li>
            <li v-if="$page.props.auth.user.is_active === 1">
                <Link
                    :href="route('trainers.activityCalendar')"
                    class="block relative group transition duration-300 px-2 py-1 rounded"
                    :class="{
                        'font-bold bg-white/20 underline-effect-active':
                            $page.component ===
                            'Trainer/TrainerActivityCalendar',
                    }"
                    @click="isMenuOpen = false"
                    ><span class="relative">
                        Actividades
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                        ></span>
                    </span>
                    <span
                        v-if="
                            $page.component ===
                            'Trainer/TrainerActivityCalendar'
                        "
                        class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                    ></span>
                </Link>
            </li>
            <li v-if="$page.props.auth.user.is_active === 1">
                <Link
                    :href="route('trainers.posts')"
                    class="block relative group transition duration-300 px-2 py-1 rounded"
                    :class="{
                        'font-bold bg-white/20 underline-effect-active':
                            $page.component === 'Trainer/TrainerPosts',
                    }"
                    @click="isMenuOpen = false"
                    ><span class="relative">
                        Posts
                        <span
                            class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"
                        ></span>
                    </span>
                    <span
                        v-if="$page.component === 'Trainer/TrainerPosts'"
                        class="absolute -bottom-1 left-0 w-full h-0.5 bg-white pulse-animation"
                    ></span>
                </Link>
            </li>
            <li>
                <button
                    @click="logout"
                    class="block relative group transition duration-300 px-2 py-1 rounded hover:bg-white/10 w-full text-left"
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
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { router } from "@inertiajs/vue3";
import { useThemeStore } from "../../../../stores/useThemeStore.js";
import { storeToRefs } from "pinia";

const themeStore = useThemeStore();
const { isDark } = storeToRefs(themeStore);

const isMenuOpen = ref(false);

const logout = () => {
    router.post(route("logout"));
};

// Efecto de parpadeo para la pestaña activa
let intervalId = null;

onMounted(() => {
    // Iniciar el efecto de parpadeo cada 3 segundos
    intervalId = setInterval(() => {
        const activeTabIndicator = document.querySelector(".pulse-animation");
        if (activeTabIndicator) {
            activeTabIndicator.classList.add("animate-pulse");
            setTimeout(() => {
                activeTabIndicator.classList.remove("animate-pulse");
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

/* Transición para el menú móvil */
.transition-all {
    transition-property: all;
}
</style>
