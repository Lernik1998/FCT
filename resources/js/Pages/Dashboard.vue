<script setup>
import AppLayout from "@/Layouts/AppLayoutPREVIOUS.vue";
import Welcome from "@/Components/Welcome.vue";

import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

const auth = usePage().props.auth;
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>

    <div>
        <h1>Bienvenido al Dashboard</h1>

        <div v-if="auth.user.role === 'admin'">
            <p>Contenido exclusivo para Administradores</p>
        </div>

        <div v-if="auth.user.role === 'trainer'">
            <p>Contenido exclusivo para Entrenadores</p>
        </div>

        <div v-if="auth.user.role === 'user'">
            <p>Contenido exclusivo para Usuarios</p>
        </div>
    </div>
</template>
