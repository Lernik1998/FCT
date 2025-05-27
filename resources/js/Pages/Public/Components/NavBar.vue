<template>
    <nav
        class="p-4 border-b shadow-md bg-white dark:bg-gray-800 dark:text-white"
    >
        <div
            class="max-w-7xl mx-auto flex justify-between items-center flex-wrap"
        >
            <!-- Logo y botones -->
            <div class="flex items-center space-x-4">
                <span class="text-xl font-bold dark:text-orange-600">FitWorking</span>

                <!-- Botón de tema -->
                <button
                    @click="themeStore.toggleDarkMode"
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition transform hover:scale-110 duration-300"
                    :aria-label="
                        isDark
                            ? 'Cambiar a modo claro'
                            : 'Cambiar a modo oscuro'
                    "
                    :title="isDark ? 'Modo claro' : 'Modo oscuro'"
                >
                    <svg
                        v-if="isDark"
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
                </button>

                <!-- Idiomas -->
                <LanguageSelector />
            </div>

            <!-- Botón hamburguesa (visible en móvil) -->
            <button
                @click="isMobileMenuOpen = !isMobileMenuOpen"
                class="md:hidden mt-2 text-gray-800 dark:text-white focus:outline-none transition transform hover:scale-110 duration-300"
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

            <!-- Enlaces navegación -->
            <div
                :class="[
                    'w-full md:w-auto',
                    isMobileMenuOpen ? 'block' : 'hidden',
                    'md:block',
                ]"
            >
                <ul
                    class="flex flex-col md:flex-row md:items-center md:space-x-6 mt-4 md:mt-0"
                >
                    <li>
                        <Link
                            :href="route('index')"
                            class="relative group transition duration-300"
                            :class="{
                                'font-bold text-orange-500':
                                    $page.component === 'Index',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                {{ $t("pages.Nav.home") }}
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Index'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('activities.index')"
                            class="relative group transition duration-300"
                            :class="{
                                'font-bold text-orange-500':
                                    $page.component === 'Public/Activity',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                {{ $t("pages.Nav.activities") }}
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Public/Activity'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('trainers.index')"
                            class="relative group transition duration-300"
                            :class="{
                                'font-bold text-orange-500':
                                    $page.component === 'Public/Trainer',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                {{ $t("pages.Nav.trainers") }}
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Public/Trainer'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('posts.index')"
                            class="relative group transition duration-300"
                            :class="{
                                'font-bold text-orange-500':
                                    $page.component === 'Public/Posts',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                {{ $t("pages.Nav.posts") }}
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Public/Posts'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 pulse-animation"
                            ></span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('contact')"
                            class="relative group transition duration-300"
                            :class="{
                                'font-bold text-orange-500':
                                    $page.component === 'Public/Contact',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                {{ $t("pages.Nav.contact") }}
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Public/Contact'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 pulse-animation"
                            ></span>
                        </Link>
                    </li>

                    <li v-if="$page.props.auth.user">
                        <Link
                            :href="route('dashboard')"
                            class="relative group transition duration-300"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                Acceso
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                        </Link>
                    </li>
                    <li v-else>
                        <Link
                            :href="route('login')"
                            class="relative group transition duration-300"
                            :class="{
                                'font-bold text-orange-500':
                                    $page.component === 'Auth/Login',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            <span class="relative">
                                {{ $t("pages.Nav.login") }}
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-0.5 bg-orange-500 transition-all duration-300 group-hover:w-full"
                                ></span>
                            </span>
                            <span
                                v-if="$page.component === 'Auth/Login'"
                                class="absolute -bottom-1 left-0 w-full h-0.5 bg-orange-500 pulse-animation"
                            ></span>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { useThemeStore } from "../../../../stores/useThemeStore.js";
import { storeToRefs } from "pinia";
import LanguageSelector from "@/Components/LanguageSelector.vue";

const isMobileMenuOpen = ref(false);

const themeStore = useThemeStore();
const { isDark } = storeToRefs(themeStore);

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

<style>
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

/* Transición para los botones */
.transition {
    transition-property: background-color, transform;
    transition-duration: 300ms;
    transition-timing-function: ease-in-out;
}

/* Escalado al hover para botones */
.transform {
    transform: scale(1);
}

.hover\:scale-110:hover {
    transform: scale(1.1);
}

.duration-300 {
    transition-duration: 300ms;
}
</style>
