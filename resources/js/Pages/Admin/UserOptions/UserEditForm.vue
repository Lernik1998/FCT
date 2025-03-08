<template>
    <!-- Barra de navegación -->
    <nav class="p-4 border-b shadow-md bg-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Panel de Administración</div>
            <AdminNavBar />
        </div>
    </nav>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Edición del usuario</h1>
        <form @submit.prevent="submit" class="space-y-4">
            <div class="mb-3">
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                    >Nombre</label
                >
                <input
                    type="text"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    id="name"
                    v-model="name"
                />
            </div>
            <div class="mb-3">
                <label
                    for="email"
                    class="block text-sm font-medium text-gray-700"
                    >Correo electrónico</label
                >
                <input
                    type="email"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    id="email"
                    v-model="email"
                />
            </div>
            <div class="mb-3">
                <label
                    for="role"
                    class="block text-sm font-medium text-gray-700"
                    >Rol</label
                >
                <select
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    id="role"
                    v-model="role"
                >
                    <option value="user">Usuario</option>
                    <option value="trainer">Entrenador</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <button
                @click="editarUsuario"
                type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Guardar cambios
            </button>

            <button
                @click="() => router.visit(route('admin.userAdmin'))"
                type="button"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            >
                Cancelar
            </button>
        </form>
    </div>
</template>

<script setup>
// Importaciones
import { defineProps, ref } from "vue";
import { router } from "@inertiajs/vue3";

// Componentes
import AdminNavBar from "@/Pages/Admin/Components/AdminNavBar.vue";

// Propiedades
const props = defineProps({
    user: Object,
});

const name = ref(props.user.name);
const email = ref(props.user.email);
const role = ref(props.user.role);

const editarUsuario = () => {
    // Envio los datos al controlador
    // router.put(route("admin.updateUser", props.user.id), {
    //     name: name.value,
    //     email: email.value,
    //     role: role.value,
    // });

    // Si no se ha hecho ningún cambio y se quiere guardar, no hago nada
    if (
        name.value === props.user.name &&
        email.value === props.user.email &&
        role.value === props.user.role
    ) {
        return alert("No se ha hecho ninguna modificación");
    }

    if (confirm("¿Seguro que deseas editar este usuario?")) {
        router.put(route("admin.updateUser", props.user.id), {
            name: name.value,
            email: email.value,
            role: role.value,
        });
    }
};
</script>

<style scoped></style>
