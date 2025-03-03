<template>
    <AdminNavBar />

    <section>
        <h1>Opciones</h1>
        <a :href="route('admin.createActivityView')">Crear actividad</a>
    </section>

    <section class="min-h-screen bg-gray-100 py-12 px-6">
        <div
            class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6 animate-fade-in"
        >
            <!-- Título -->
            <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">
                Gestión de Actividades
            </h1>

            <!-- Tabla de actividades -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-3 px-4 text-left">Nombre</th>
                            <th class="py-3 px-4 text-left">Descripción</th>
                            <th class="py-3 px-4 text-center">Fecha</th>
                            <th class="py-3 px-4 text-center">Estado</th>
                            <th class="py-3 px-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="activity in activities"
                            :key="activity.id"
                            class="border-t"
                        >
                            <td class="py-3 px-4">{{ activity.name }}</td>
                            <td class="py-3 px-4 truncate w-64">
                                {{ activity.description }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                {{ activity.date }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span
                                    :class="[
                                        activity.is_active === 'true'
                                            ? 'bg-green-500'
                                            : 'bg-red-500',
                                    ]"
                                >
                                    {{
                                        activity.is_active
                                            ? "Activo"
                                            : "Inactivo"
                                    }}
                                </span>
                            </td>
                            <td class="py-3 px-4 flex justify-center space-x-2">
                                <button
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition"
                                    @click="showActivity(activity.id)"
                                >
                                    Ver
                                </button>
                                <button
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition"
                                    @click="editActivity(activity.id)"
                                >
                                    Editar
                                </button>
                                <button
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                                    @click="deleteActivity(activity.id)"
                                >
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

// Componentes
import AdminNavBar from "./Components/AdminNavBar.vue";

const props = defineProps(["activities"]);

const showActivity = (id) => {
    router.visit(route("admin.activityShow", id));
};

const editActivity = (id) => {
    router.visit(route("admin.activityEdit", id));
};

const deleteActivity = (id) => {
    if (confirm("¿Seguro que deseas eliminar esta actividad?")) {
        router.delete(route("admin.activityDestroy", id));
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
