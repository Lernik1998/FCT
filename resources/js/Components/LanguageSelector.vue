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
import { loadLanguageAsync } from "laravel-vue-i18n";

// Estado del menú
const languageMenuOpen = ref(false);

// Lenguajes disponibles
const availableLanguages = reactive({
    items: [
        { title: "Español", value: "es" },
        { title: "English", value: "en" },
        { title: "Français", value: "fr" },
    ],
});

// Referencia al contenedor del menú
const languageMenuContainer = ref(null);

// Alternar menú
function toggleLanguageMenu() {
    languageMenuOpen.value = !languageMenuOpen.value;
}

// Cerrar menú si se hace clic fuera
function closeMenuIfClickedOutside(event) {
    if (
        languageMenuContainer.value &&
        !languageMenuContainer.value.contains(event.target)
    ) {
        languageMenuOpen.value = false;
    }
}

// Cambiar idioma
const changeLanguage = async (item) => {
    localStorage.setItem("lang", item.value);
    await loadLanguageAsync(item.value);
    languageMenuOpen.value = false; // Cierra el menú correctamente
};

// Inicializar idioma desde localStorage o usar español
onMounted(async () => {
    const storedLang = localStorage.getItem("lang") || "es";
    await loadLanguageAsync(storedLang);

    document.addEventListener("click", closeMenuIfClickedOutside);
});

onUnmounted(() => {
    document.removeEventListener("click", closeMenuIfClickedOutside);
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

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

div {
    transition: transform 0.2s ease-out;
}

div[style*="transform"] {
    transform: translateY(10px);
}

.z-50 {
    z-index: 50 !important;
}
</style>
