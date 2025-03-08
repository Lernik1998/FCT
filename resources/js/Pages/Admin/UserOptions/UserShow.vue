<template>
    <!-- Barra de navegación -->
    <nav class="p-4 border-b shadow-md bg-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Panel de Administración</div>
            <AdminNavBar />
        </div>
    </nav>

    <section class="flex justify-center mt-32 p-6">
        <div
            class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-2xl text-center animate-fade-in border border-gray-200"
        >
            <h1 class="text-4xl font-extrabold text-gray-900 mb-6">
                Ficha del Usuario
            </h1>
            <div class="space-y-4">
                <p class="text-2xl font-semibold text-gray-800">
                    {{ user.name }}
                </p>
                <p class="text-lg text-gray-600">{{ user.email }}</p>
                <span
                    class="px-5 py-2 rounded-full text-lg font-medium shadow-md"
                    :class="
                        role === 'user'
                            ? 'bg-blue-600 text-white'
                            : 'bg-green-600 text-white'
                    "
                >
                    {{ user.role }}
                </span>
            </div>

            <div class="mt-8 flex justify-center space-x-6">
                <a
                    :href="route('admin.editUser', user.id)"
                    class="text-lg text-blue-600 font-semibold hover:text-blue-800 transition"
                >
                    Editar
                </a>
                <a
                    :href="route('admin.userAdmin')"
                    class="text-lg text-blue-600 font-semibold hover:text-blue-800 transition"
                >
                    Volver
                </a>
            </div>

            <button
                @click="deleteUser(user.id)"
                class="bg-red-500 text-white px-6 py-3 rounded-xl mt-6 text-lg font-semibold shadow-md hover:bg-red-700 transition"
            >
                Eliminar usuario
            </button>
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

// Componentes
import AdminNavBar from "@/Pages/Admin/Components/AdminNavBar.vue";

const props = defineProps({
    user: Object,
});

const role = props.user.role;

// Eliminar usuario
const deleteUser = (id) => {
    if (confirm("¿Seguro que deseas eliminar este usuario?")) {
        router.delete(route("admin.destroyUser", id));
    }
};
</script>

<style scoped>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}
</style>
