<template>
    <section
        class="min-h-screen bg-gray-100 dark:bg-gray-900 py-6 sm:py-12 px-4 sm:px-6 flex justify-center transition-colors duration-300"
    >
        <div
            class="max-w-3xl w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4 sm:p-8 animate-fade-in transition-colors duration-300"
        >
            <!-- Título -->
            <h1
                class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-orange-600 text-center mb-4 sm:mb-6"
            >
                Editar actividad
            </h1>

            <!-- Formulario -->
            <form
                @submit.prevent="updateActivity"
                class="space-y-4 sm:space-y-6"
                enctype="multipart/form-data"
            >
                <!-- Nombre -->
                <div>
                    <label
                        class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                    >
                        Nombre de la actividad
                    </label>
                    <input
                        type="text"
                        v-model="activity.name"
                        class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                        required
                    />
                </div>

                <!-- Descripción -->
                <div>
                    <label
                        class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                    >
                        Descripción
                    </label>
                    <textarea
                        v-model="activity.description"
                        class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                        rows="4"
                        required
                    ></textarea>
                </div>

                <!-- Imagen Actual -->
                <div v-if="activity.image">
                    <label
                        class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300 mb-2"
                    >
                        Imagen Actual
                    </label>
                    <div
                        class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700"
                    >
                        <img
                            :src="activity.image"
                            alt="Imagen actual"
                            class="w-full h-auto max-h-64 object-contain"
                        />
                    </div>
                </div>

                <!-- Nueva Imagen -->
                <div>
                    <label
                        class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                    >
                        Nueva Imagen (Opcional)
                    </label>
                    <input
                        type="file"
                        @change="handleFileUpload"
                        accept="image/*"
                        class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-100 dark:hover:file:bg-gray-500 transition"
                    />
                </div>

                <!-- Grid para Precio-->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Precio -->
                    <div>
                        <label
                            class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                        >
                            Precio
                        </label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                            >
                                <span
                                    class="text-gray-500 dark:text-gray-400 sm:text-sm"
                                    >€</span
                                >
                            </div>
                            <input
                                type="number"
                                v-model="activity.price"
                                min="0"
                                step="0.01"
                                class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 py-2 sm:py-3 pl-7 pr-12 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                                placeholder="0.00"
                                required
                            />
                        </div>
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label
                            class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                        >
                            Fecha
                        </label>
                        <input
                            type="date"
                            v-model="activity.date"
                            class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                            required
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Horario inicio-->
                    <div>
                        <label
                            class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                        >
                            Horario inicio
                        </label>
                        <input
                            type="time"
                            v-model="activity.start_time"
                            class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                            required
                        />
                    </div>

                    <!-- Horario fin-->
                    <div>
                        <label
                            class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                        >
                            Horario fin
                        </label>
                        <input
                            type="time"
                            v-model="activity.end_time"
                            class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                            required
                        />
                    </div>
                </div>

                <!-- Estado -->
                <div>
                    <label
                        class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                    >
                        Estado
                    </label>
                    <select
                        v-model="activity.status"
                        class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                        required
                    >
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                        <option value="pending">Pendiente</option>
                    </select>
                </div>

                <!-- Capacidad -->
                <div>
                    <div>
                        <label
                            class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                        >
                            Capacidad
                        </label>
                        <input
                            min="1"
                            type="number"
                            v-model="activity.capacity"
                            class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                            required
                        />
                    </div>
                    <!-- En la sección del select de categorías -->
                    <div>
                        <label
                            class="block text-sm sm:text-base font-semibold text-gray-700 dark:text-gray-300"
                        >
                            Categoria
                        </label>
                        <select
                            v-model="activity.category_id"
                            class="w-full mt-1 p-2 sm:p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition"
                            required
                        >
                            <option value="">Selecciona una categoría</option>
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Botón -->
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white py-2 sm:py-3 px-4 rounded-lg font-medium transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                >
                    Actualizar Actividad
                </button>
            </form>

            <!-- Mensaje de éxito -->
            <div
                v-if="successMessage"
                class="mt-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-green-700 dark:text-green-300 text-center transition-all duration-300"
            >
                <p class="font-semibold flex items-center justify-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    {{ successMessage }}
                </p>
            </div>
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { ref, defineProps } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({
    layout: AdminLayout,
});

// Recibe la actividad como prop
const props = defineProps({
    activity: Object,
    categories: Array,
});

// Imagen
const image = "/images/activities/" + props.activity.image;

// Estado de la actividad con valores precargados
const activity = ref({
    ...props.activity,
    category_id: props.activity.category_id,
});

const successMessage = ref("");

// Manejo de carga de imagen

const handleFileUpload = (event) => {
    activity.value.image = event.target.files[0];
};

// Función para actualizar la actividad
const updateActivity = () => {
    // Solo enviar la imagen si es un archivo nuevo
    const formData = new FormData();

    // Agregar todos los campos excepto la imagen
    Object.keys(activity.value).forEach((key) => {
        if (key !== "image" || activity.value[key] instanceof File) {
            formData.append(key, activity.value[key]);
        }
    });

    // Enviar datos
    router.put(route("admin.updateActivity", activity.value.id), formData, {
        onSuccess: () => {
            successMessage.value = "¡Actividad actualizada exitosamente! 🎉";
        },
    });
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
