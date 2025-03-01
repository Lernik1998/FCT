<template>

    <section
        class="flex justify-center items-center min-h-screen bg-gray-100 p-6"
    >
        <div
            class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md text-center animate-fade-in"
        >
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Ficha del Usuario
            </h1>
            <div class="space-y-2">
                <p class="text-lg font-semibold text-gray-700">
                    {{ user.name }}
                </p>
                <p class="text-gray-600">{{ user.email }}</p>
                <span
                    class="px-4 py-1 rounded-full text-sm font-medium"
                    :class="
                        user.role === 'admin'
                            ? 'bg-red-500 text-white'
                            : 'bg-blue-500 text-white'
                    "
                >
                    {{ user.role }}
                </span>
            </div>

            <div class="mt-6 flex space-x-4">
                <a
                    :href="route('admin.editUser', user.id)"
                    class="text-blue-600 hover:underline"
                    >Editar</a
                >
                <a
                    :href="route('admin.userAdmin')"
                    class="text-blue-600 hover:underline"
                    >Volver</a
                >

                <button
                    @click="deleteUser(user.id)"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4"
                >
                    Eliminar usuario
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
});

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
