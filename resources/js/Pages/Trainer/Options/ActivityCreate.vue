<template>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <!-- Contenedor principal -->
        <div class="max-w-3xl mx-auto">
            <!-- Header con botón de volver -->
            <div class="flex items-center justify-between mb-8">
                <button
                    @click="volver"
                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-1"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Volver
                </button>
                <h1 class="text-2xl font-bold text-gray-900">
                    Nueva Actividad
                </h1>
                <div class="w-6"></div>
                <!-- Espaciador para alinear -->
            </div>

            <!-- Card del formulario -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <form
                    @submit.prevent="submitForm"
                    class="divide-y divide-gray-200"
                    enctype="multipart/form-data"
                >
                    <!-- Sección 1: Información básica -->
                    <div class="px-6 py-5">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">
                            Información básica
                        </h2>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <!-- Nombre -->
                            <div class="col-span-2">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Nombre</label
                                >
                                <input
                                    type="text"
                                    v-model="activity.name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Ej: CrossFit, Yoga, Spinning"
                                    required
                                />
                            </div>

                            <!-- Descripción -->
                            <div class="col-span-2">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Descripción</label
                                >
                                <textarea
                                    v-model="activity.description"
                                    rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Describe la actividad..."
                                    required
                                ></textarea>
                            </div>

                            <!-- Imagen -->
                            <div class="col-span-2">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Imagen</label
                                >
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
                                >
                                    <div class="space-y-1 text-center">
                                        <div class="flex text-sm text-gray-600">
                                            <label
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none"
                                            >
                                                <span>Subir archivo</span>
                                                <input
                                                    type="file"
                                                    @change="handleFileUpload"
                                                    accept="image/*"
                                                    class="sr-only"
                                                    required
                                                />
                                            </label>
                                            <p class="pl-1">
                                                o arrastrar y soltar
                                            </p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF hasta 2MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección 2: Detalles de la actividad -->
                    <div class="px-6 py-5">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">
                            Detalles de la actividad
                        </h2>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <!-- Precio -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Precio (€)</label
                                >
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        type="number"
                                        v-model="activity.price"
                                        class="block w-full pr-12 pl-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required
                                    />
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
                                    >
                                        <span class="text-gray-500 sm:text-sm"
                                            >€</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Duración -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Duración (min)</label
                                >
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input
                                        type="number"
                                        v-model="activity.duration"
                                        class="block w-full pr-12 pl-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required
                                    />
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
                                    >
                                        <span class="text-gray-500 sm:text-sm"
                                            >min</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Fecha -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Fecha</label
                                >
                                <input
                                    type="date"
                                    v-model="activity.date"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    required
                                />
                            </div>

                            <!-- Categoría -->
                            <!-- <div class="col-span-3">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Categoría</label
                                >
                                <select
                                    v-model="activity.category_id"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md"
                                    required
                                >
                                    <option value="" disabled selected>
                                        Selecciona una categoría
                                    </option>
                                    <option
                                        v-for="category in categories"
                                        :key="category.id"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div> -->
                        </div>
                    </div>

                    <!-- Sección de acciones -->
                    <div class="px-6 py-4 bg-gray-50 text-right">
                        <button
                            type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Crear actividad
                        </button>
                    </div>
                </form>
            </div>

            <!-- Mensaje de éxito -->
            <div v-if="successMessage" class="mt-4">
                <div class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg
                                class="h-5 w-5 text-green-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ successMessage }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// Importaciones
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { defineProps } from "vue";
import TrainerLayout from "@/Layouts/TrainerLayout.vue";

defineOptions({
    layout: TrainerLayout,
});

const props = defineProps({
    categories: Array,
});

const handleFileUpload = (event) => {
    activity.value.image = event.target.files[0];
};

// Estado de la actividad
const activity = ref({
    name: "",
    description: "",
    image: "",
    date: "",
    duration: "",
    price: "",
    category_id: "",
});

const successMessage = ref("");

// Función para enviar formulario
const submitForm = () => {
    console.log("Actividad creada:", activity.value);
    successMessage.value = "¡Actividad creada exitosamente! 🎉";

    // Envio los datos al controlador
    router.post(route("trainers.storeActivity"), activity.value);
};

const volver = () => {
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
