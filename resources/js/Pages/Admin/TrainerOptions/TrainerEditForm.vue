<template>
    <div
        class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4 sm:p-6 transition-colors duration-300"
    >
        <!-- Botón volver -->
        <div class="max-w-6xl mx-auto mb-6">
            <button
                @click="router.visit(route('admin.trainerAdmin'))"
                class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white rounded-lg shadow transition-colors duration-200"
            >
                <svg
                    class="w-5 h-5 mr-2"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>
                Volver
            </button>
        </div>

        <!-- Contenedor principal -->
        <div
            class="max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-colors duration-300"
        >
            <div class="md:flex">
                <!-- Columna izquierda - Avatar -->
                <div
                    class="md:w-1/3 p-6 md:p-8 border-b md:border-b-0 md:border-r border-gray-200 dark:border-gray-700 flex flex-col items-center"
                >
                    <div
                        class="relative w-32 h-32 md:w-40 md:h-40 rounded-full bg-blue-100 dark:bg-blue-900/20 mb-4 overflow-hidden shadow-lg"
                    >
                        <img
                            :src="trainerImage"
                            :alt="form.name"
                            class="w-full h-full object-cover"
                        />
                    </div>

                    <h2
                        class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-1 text-center"
                    >
                        {{ form.name }}
                    </h2>

                    <span
                        class="px-3 py-1 rounded-full text-sm font-medium mt-2"
                        :class="{
                            'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300':
                                form.role === 'admin',
                            'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300':
                                form.role === 'trainer',
                            'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300':
                                form.role === 'user',
                        }"
                    >
                        {{ roleLabel }}
                    </span>
                </div>

                <!-- Columna derecha - Formulario -->
                <div class="md:w-2/3 p-6 md:p-8">
                    <h1
                        class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6"
                    >
                        Editar entrenador
                    </h1>

                    <form
                        @submit.prevent="submitForm"
                        class="space-y-4"
                        enctype="multipart/form-data"
                    >
                        <!-- Grid de 2 columnas para pantallas medianas/grandes -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nombre -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >
                                    Nombre
                                </label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                                />
                            </div>

                            <!-- Email -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >
                                    Correo electrónico
                                </label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                                />
                            </div>
                        </div>

                        <!-- Grid de 2 columnas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Rol -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >
                                    Rol
                                </label>
                                <select
                                    v-model="form.role"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                                >
                                    <option value="user">Usuario</option>
                                    <option value="trainer">Entrenador</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>

                            <!-- Categoría -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >
                                    Categoría
                                </label>
                                <select
                                    v-model="form.category"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                                >
                                    <option value="">
                                        Selecciona una categoría
                                    </option>
                                    <option
                                        v-for="cat in categories"
                                        :key="cat.name"
                                        :value="cat.name"
                                    >
                                        {{ cat.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div
                            class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg"
                        >
                            <span
                                class="text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Estado del entrenador
                            </span>
                            <div class="flex items-center">
                                <span
                                    class="mr-3 text-sm font-medium text-gray-700 dark:text-gray-300"
                                >
                                    {{ form.is_active ? "Activo" : "Inactivo" }}
                                </span>
                                <label
                                    class="relative inline-flex items-center cursor-pointer"
                                >
                                    <input
                                        type="checkbox"
                                        v-model="form.is_active"
                                        :true-value="1"
                                        :false-value="0"
                                        class="sr-only peer"
                                    />
                                    <div
                                        class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-500 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"
                                    ></div>
                                </label>
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >
                                Imagen del entrenador
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="shrink-0">
                                    <img
                                        :src="trainerImage"
                                        class="h-16 w-16 rounded-full object-cover"
                                        :alt="form.name"
                                    />
                                </div>
                                <label class="block">
                                    <span class="sr-only">Elegir imagen</span>
                                    <input
                                        type="file"
                                        @change="handleImageChange"
                                        accept="image/*"
                                        class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-gray-600 dark:file:text-gray-200 hover:file:bg-blue-100 dark:hover:file:bg-gray-500 transition cursor-pointer"
                                    />
                                </label>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >
                                Descripción
                            </label>
                            <textarea
                                v-model="form.description"
                                rows="4"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                            ></textarea>
                        </div>

                        <!-- Tiempo de experiencia -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >
                                Tiempo de experiencia (años)
                            </label>
                            <input
                                type="number"
                                v-model="form.experience_time"
                                min="0"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                            />
                        </div>

                        <!-- Botones de acción -->
                        <div
                            class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4"
                        >
                            <button
                                type="button"
                                @click="
                                    router.visit(route('admin.trainerAdmin'))
                                "
                                class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200"
                            >
                                Cancelar
                            </button>
                            <button
                                type="submit"
                                class="px-6 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 transition-colors duration-200"
                            >
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({
    trainer: Object,
    categories: Array,
});

const form = ref({
    name: props.trainer.name,
    email: props.trainer.email,
    role: props.trainer.role,
    category: props.trainer.category || "",
    is_active: props.trainer.is_active,
    image: props.trainer.image,
    description: props.trainer.description,
    experience_time: props.trainer.experience_time,
});

// Computed properties
const trainerImage = computed(() => {
    return form.value.image
        ? `/images/trainers/${form.value.image}`
        : "/images/default-avatar.jpg";
});

const roleLabel = computed(() => {
    return (
        {
            admin: "Administrador",
            trainer: "Entrenador",
            user: "Usuario",
        }[form.value.role] || form.value.role
    );
});

// Methods
const handleImageChange = (event) => {
    form.value.image = event.target.files[0] || form.value.image;
};

const submitForm = () => {
    if (!confirm("¿Estás seguro de que deseas actualizar este entrenador?")) {
        return;
    }

    const formData = new FormData();
    Object.entries(form.value).forEach(([key, value]) => {
        if (value !== null && value !== undefined) {
            formData.append(key, value);
        }
    });

    router.post(
        route("admin.updateTrainer", props.trainer.id),
        {
            _method: "PUT",
            ...Object.fromEntries(formData),
        },
        {
            onSuccess: () => {
                // Mostrar mensaje de éxito si lo deseas
            },
            onError: (errors) => {
                console.error("Error al actualizar:", errors);
            },
        }
    );
};
</script>

<style scoped>
/* Transiciones suaves para el modo oscuro */
.transition-colors {
    transition-property: background-color, border-color, color, fill, stroke;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}
</style>
