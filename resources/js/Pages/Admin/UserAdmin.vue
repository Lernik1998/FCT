<template>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Gestión de usuarios</h1>

        <!-- Aqui tendremos opciones de crear y filtrar usuarios para busqueda.
        Y también una paginación -->

        <!-- Acceso a crear un usuario -->
        <div>
            <a :href="route('admin.createUserView')">Crear usuario</a>
        </div>

        <!-- Sección de Usuarios -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold mb-4">Usuarios</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="user in users"
                    :key="user.id"
                    class="bg-white shadow-lg rounded-lg p-6 transform transition hover:scale-105"
                >
                    <p class="text-lg font-semibold">{{ user.name }}</p>
                    <p class="text-gray-600">{{ user.email }}</p>
                    <p class="text-sm text-blue-500 font-medium">
                        {{ user.role }}
                    </p>

                    <a
                        :href="route('admin.userShow', user.id)"
                        class="text-blue-600 hover:underline"
                        >Acceder</a
                    >
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    users: Array,
});
</script>
