<template>
    <nav
        class="p-4 border-b shadow-md bg-white dark:bg-gray-800 dark:text-white"
    >
        <div
            class="max-w-7xl mx-auto flex justify-between items-center flex-wrap"
        >
            <!-- Logo y botones -->
            <div class="flex items-center space-x-4">
                <span class="text-xl font-bold">FitWorking</span>

                <!-- Botón de tema -->
                <button
                    @click="themeStore.toggleDarkMode"
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition"
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
                class="md:hidden mt-2 text-gray-800 dark:text-white focus:outline-none"
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
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Index',
                            }"
                            @click="isMobileMenuOpen = false"
                            >{{ $t("pages.Nav.home") }}</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('activities.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Activity',
                            }"
                            @click="isMobileMenuOpen = false"
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
                            @click="isMobileMenuOpen = false"
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
                            @click="isMobileMenuOpen = false"
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
                            @click="isMobileMenuOpen = false"
                            >{{ $t("pages.Nav.contact") }}</Link
                        >
                    </li>
                    <!-- <li>
                        <Link
                            :href="route('login')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Auth/Login',
                            }"
                            @click="isMobileMenuOpen = false"
                            >{{ $t("pages.Nav.login") }}</Link
                        >
                    </li> -->

                    <li v-if="$page.props.auth.user">
                        <Link
                            :href="route('dashboard')"
                            class="hover:underline"
                            @click="isMobileMenuOpen = false"
                        >
                            Acceso
                        </Link>
                    </li>
                    <li v-else>
                        <Link
                            :href="route('login')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Auth/Login',
                            }"
                            @click="isMobileMenuOpen = false"
                        >
                            {{ $t("pages.Nav.login") }}
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from "vue";
import { useThemeStore } from "../../../../stores/useThemeStore.js";
import { storeToRefs } from "pinia";
import LanguageSelector from "@/Components/LanguageSelector.vue";

const isMobileMenuOpen = ref(false);

const themeStore = useThemeStore();
const { isDark } = storeToRefs(themeStore);
</script>
