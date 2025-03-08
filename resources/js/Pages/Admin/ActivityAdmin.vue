<template>
    <!-- Barra de navegación -->
    <nav class="p-4 border-b shadow-md bg-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Panel de Administración</div>
            <AdminNavBar />
        </div>
    </nav>

    <section class="mt-6 ml-6">
        <h1 class="text-2xl font-bold mb-4">Opciones</h1>
        <ul class="ml-10">
            <li>
                <a
                    class="text-blue-600 hover:underline"
                    :href="route('admin.createActivityView')"
                    >Crear actividad</a
                >
            </li>
        </ul>
    </section>

    <section class="ml-10">
        <!-- Filtrado de actividades por el status -->
        <h3 class="text-lg font-semibold mt-6 mb-2">
            Filtrado de actividades por el estado y por la fecha estaría bien
            TENER UN COMPONENTE DE FILTRADO
        </h3>
    </section>

    <section class="min-h-screen py-12 px-6">
        <div class="bg-white shadow-lg rounded-lg p-6 animate-fade-in w-full">
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
                            <td
                                class="py-3 px-4 overflow-hidden text-ellipsis whitespace-nowrap"
                            >
                                {{
                                    activity.description.length > 50
                                        ? activity.description.slice(0, 50) +
                                          "..."
                                        : activity.description
                                }}
                            </td>

                            <td class="py-3 px-4 text-center">
                                {{ activity.date }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span :class="statusClass(activity.status)">
                                    {{
                                        activity.status === "active"
                                            ? "Activo"
                                            : activity.status === "inactive"
                                            ? "Inactivo"
                                            : "Pendiente"
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

const statusClass = (status) => {
    if (status === "active") {
        return "bg-green-500 px-3 py-1 rounded text-white";
    } else if (status === "inactive") {
        return "bg-red-500 px-3 py-1 rounded text-white";
    } else {
        return "bg-yellow-500 px-3 py-1 rounded text-white";
    }
};

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
