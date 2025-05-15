<template>
    <!-- <AppLayout title="Dashboard"> -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
            >
                <div
                    class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900"
                >
                    <div
                        class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 max-w-md w-full text-center"
                    >
                        <h2
                            class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4"
                        >
                            Sesión caducada
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            Tu sesión ha expirado por inactividad o cierre. Por
                            favor, vuelve a iniciar sesión para continuar.
                        </p>
                        <a
                            @click="logout()"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition"
                        >
                            Cerrar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";

defineOptions({
    layout: PublicLayout,
});

defineProps({
    auth: Object,
});

function logout() {
    router.post(route("logout"));
}
</script>
