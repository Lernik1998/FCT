<template>
    <nav class="bg-white border-b border-gray-200 shadow-sm px-4 py-3">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-800">
                Panel de Administración
            </div>

            <ul class="flex items-center space-x-8 py-3">
                <!-- Inicio -->
                <li>
                    <a
                        :href="route('admin.index')"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200"
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
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center"
                        :class="{
                            'text-blue-600 bg-blue-50': route().current(
                                'admin.informationAdmin'
                            ),
                        }"
                    >
                        <span>Solicitudes información</span>
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
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                        :class="{
                            'text-blue-600 bg-blue-50':
                                route().current('admin.messageAdmin'),
                        }"
                    >
                        Mensajes trainers
                    </a>
                </li>

                <!-- Cerrar sesión -->
                <li class="ml-auto">
                    <button
                        @click="logout"
                        class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center"
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
</script>
