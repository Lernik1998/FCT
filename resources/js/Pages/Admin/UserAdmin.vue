<template>
    <!-- Barra de navegación -->
    <nav class="p-4 border-b shadow-md bg-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Panel de Administración</div>
            <AdminNavBar />
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Gestión de usuarios</h1>

        <!-- Aqui tendremos opciones de crear y filtrar usuarios para busqueda.
        Y también una paginación -->

        <!-- Acceso a crear un usuario -->
        <div class="mb-10">
            <a
                :href="route('admin.createUserView')"
                class="mb-6 bg-white p-6 rounded-lg shadow-lg"
                >Crear usuario</a
            >
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
// Importaciones

// Componentes
import AdminNavBar from "@/Pages/Admin/Components/AdminNavBar.vue";

const props = defineProps({
    users: Array,
});
</script>
