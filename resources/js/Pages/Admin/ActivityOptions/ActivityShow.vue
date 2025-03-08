<template>
    <!-- Barra de navegación -->
    <nav class="p-4 border-b shadow-md bg-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Panel de Administración</div>
            <AdminNavBar />
        </div>
    </nav>

    <section class="min-h-screen bg-gray-100 py-12 px-6 flex justify-center">
        <div
            class="max-w-2xl w-full bg-white shadow-lg rounded-lg p-6 animate-fade-in"
        >
            <!-- Título -->
            <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">
                {{ activity.name }}
            </h1>

            <!-- Información de la Actividad -->
            <div class="space-y-4">
                <!-- Descripción -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-700">
                        Descripción
                    </h2>
                    <p class="text-gray-600">
                        {{
                            activity.description.length > 50
                                ? activity.description.slice(0, 50) + "..."
                                : activity.description
                        }}
                    </p>
                </div>

                <!-- Imagen -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-700">Imagen</h2>
                    <img
                        :src="image"
                        alt="Imagen de la actividad"
                        class="w-full h-auto"
                    />
                </div>

                <!-- Fecha -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-700">Fecha</h2>
                    <p class="text-gray-600">{{ formatDate(activity.date) }}</p>
                </div>

                <!-- Estado -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-700">Estado</h2>
                    <span
                        :class="statusClass(activity.status)"
                        class="px-3 py-1 rounded-full text-white"
                    >
                        {{
                            activity.status === "active"
                                ? "Activo"
                                : activity.status === "inactive"
                                ? "Inactivo"
                                : "Pendiente"
                        }}
                    </span>
                </div>

                <!-- Botón de Volver -->
                <div class="text-center mt-6">
                    <button
                        @click="goBack"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
                    >
                        Volver
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Componentes
import AdminNavBar from "@/Pages/Admin/Components/AdminNavBar.vue";

// Recibe la actividad como prop
const props = defineProps({
    activity: Object,
});

// Imagen
const image = "/images/activities/" + props.activity.image;

// Función para formatear la fecha
const formatDate = (date) => {
    return new Date(date).toLocaleDateString();
};

// Asignar colores según estado
const statusClass = (status) => {
    return status === "active"
        ? "bg-green-500 px-3 py-1 rounded text-white"
        : status === "inactive"
        ? "bg-red-500 px-3 py-1 rounded text-white"
        : "bg-yellow-500 px-3 py-1 rounded text-white";
};

// Volver a la página anterior
const goBack = () => {
    window.history.back();
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
