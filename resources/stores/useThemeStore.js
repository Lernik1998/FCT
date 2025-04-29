// Para darkmode

import { defineStore } from "pinia";
import { ref, watchEffect } from "vue";

export const useThemeStore = defineStore("theme", () => {
    // 1. Estado inicial - Detecta preferencia del sistema
    const isDark = ref(
        localStorage.getItem("theme")
            ? localStorage.getItem("theme") === "dark"
            : window.matchMedia("(prefers-color-scheme: dark)").matches
    );

    // 2. Función para cambiar el tema
    function toggleDarkMode() {
        isDark.value = !isDark.value;
        console.log("Dark mode:", isDark.value);
    }

    // 3. Aplicar el tema al HTML (para Tailwind)
    function applyTheme() {
        if (isDark.value) {
            document.documentElement.classList.add("dark");
            localStorage.setItem("theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("theme", "light");
        }
    }

    // 4. Escuchar cambios en la preferencia del sistema
    const mediaQuery = window.matchMedia("(prefers-color-scheme: dark)");
    const handleSystemThemeChange = (e) => {
        // Solo cambia si no hay preferencia guardada
        if (!localStorage.getItem("theme")) {
            isDark.value = e.matches;
        }
    };
    mediaQuery.addEventListener("change", handleSystemThemeChange);

    // 5. Aplicar el tema inicial y observar cambios
    applyTheme();
    watchEffect(applyTheme);

    return {
        isDark,
        toggleDarkMode,
        // Limpieza del event listener cuando el store se destruye
        $onDestroy: () => {
            mediaQuery.removeEventListener("change", handleSystemThemeChange);
        },
    };
});
