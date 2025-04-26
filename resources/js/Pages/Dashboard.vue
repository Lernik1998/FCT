<template>
    <!-- <AppLayout title="Dashboard"> -->

    <!-- <template #header>
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
            Dashboard
        </h2>
    </template> -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
            >
                <!-- <Welcome /> -->
            </div>
        </div>
    </div>

    <!-- </AppLayout> -->

    <div>
        <h1>Bienvenido al Dashboard</h1>

        <!-- <div v-if="auth.user.role === 'admin'">
            <p>Contenido exclusivo para Administradores</p>
        </div> -->
    </div>
</template>

<script setup>
// import AppLayout from "vendor/laravel/jetstream/stubs/inertia/resources/js/Layouts/AppLayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
// import Welcome from "@/Components/Welcome.vue";

defineOptions({
    layout: AppLayout,
});

// import { usePage } from "@inertiajs/vue3";

// const auth = usePage().props.auth;
</script>
