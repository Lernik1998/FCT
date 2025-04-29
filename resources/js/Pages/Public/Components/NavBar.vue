<template>
    <nav
        class="p-4 border-b shadow-md bg-white dark:bg-gray-800 dark:text-white"
    >
        <div class="mx-auto flex justify-between items-center">
            <!-- Logo y botones de tema e idioma -->
            <div class="text-xl font-bold flex items-center">
                <span>FitWorking</span>

                <!-- Botón de toggle mejorado -->
                <button
                    @click="themeStore.toggleDarkMode"
                    class="p-2 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700 ml-4"
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

                <!-- Componente de idioma y tema -->
                <LanguageSelector />
            </div>

            <!-- Menú de navegación -->
            <div>
                <ul class="flex space-x-6">
                    <li>
                        <Link
                            :href="route('index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Index',
                            }"
                        >
                            {{ $t("pages.Nav.home") }}
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('activities.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Activity',
                            }"
                            >{{ $t("pages.Nav.activities") }}</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('trainers.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Trainer',
                            }"
                            >{{ $t("pages.Nav.trainers") }}</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('posts.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Posts',
                            }"
                            >{{ $t("pages.Nav.posts") }}</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('contact')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Contact',
                            }"
                            >{{ $t("pages.Nav.contact") }}</Link
                        >
                    </li>
                    <li>
                        <Link :href="route('login')" class="hover:underline">{{
                            $t("pages.Nav.login")
                        }}</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
// import { router } from "@inertiajs/vue3";
import { useThemeStore } from "../../../../stores/useThemeStore.js";
import { storeToRefs } from "pinia";
import LanguageSelector from "@/Components/LanguageSelector.vue";

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
