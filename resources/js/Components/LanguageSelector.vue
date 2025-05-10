<template>
    <div class="flex items-center space-x-4">
        <div class="relative" ref="languageMenuContainer">
            <button
                @click="toggleLanguageMenu"
                class="flex items-center gap-2 px-3 py-2 rounded-md bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200"
            >
                🌐
            </button>

            <!-- Menú desplegable -->
            <div
                v-if="languageMenuOpen"
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden z-50"
            >
                <ul class="py-1">
                    <li
                        v-for="lang in availableLanguages.items"
                        :key="lang.value"
                        @click="changeLanguage(lang)"
                        class="px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-150"
                    >
                        {{ lang.title }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, onUnmounted } from "vue";
import { router } from "@inertiajs/vue3";
import { loadLanguageAsync } from "laravel-vue-i18n";

const languageMenuOpen = ref(false);
const availableLanguages = reactive({
    items: [
        { title: "Español", value: "es" },
        { title: "English", value: "en" },
        { title: "Français", value: "fr" },
    ],
});

// Función para alternar el estado del menú
function toggleLanguageMenu() {
    languageMenuOpen.value = !languageMenuOpen.value;
}

// Función para cerrar el menú al hacer clic fuera de él
function closeMenuIfClickedOutside(event) {
    if ($refs.languageMenuContainer && !$refs.languageMenuContainer.contains(event.target)) {
        languageMenuOpen.value = false;
    }
}

// Cambiar el idioma y cerrar el menú
const changeLanguage = (item) => {
    localStorage.setItem("lang", item.value);
    loadLanguageAsync(item.value);
    router.get(route("language", item.value));
    languageMenuOpen.value = false; // Cerrar el menú al cambiar el idioma
};

// Cerrar el menú cuando se haga clic fuera
onMounted(() => {
    document.addEventListener('click', closeMenuIfClickedOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', closeMenuIfClickedOutside);
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Estilo adicional para el menú desplegable */
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

/* El menú debe estar alineado correctamente */
/* button:focus + div {
    outline: none;
    box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
} */

/* Animación para el menú desplegable */
div {
    transition: transform 0.2s ease-out;
}

div[style*="transform"] {
    transform: translateY(10px);
}

/* Asegurarse de que el menú se apile correctamente por encima de otros elementos */
.z-50 {
    z-index: 50 !important;
}
</style>
