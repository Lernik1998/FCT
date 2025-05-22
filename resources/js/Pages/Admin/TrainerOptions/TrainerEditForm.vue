<template>

    <!-- Botón volver -->
    <section class="max-w-4xl mx-auto mt-4 sm:mt-6 px-4 sm:px-0">
        <button
            @click="() => router.visit(route('admin.trainerAdmin'))"
            class="inline-flex items-center px-4 py-2 sm:px-6 sm:py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 font-medium shadow-sm transition-colors duration-200"
        >
            <svg
                class="w-4 h-4 sm:w-5 sm:h-5 mr-2 -ml-1"
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
    </section>

    <section
        class="max-w-4xl mx-auto mt-6 sm:mt-10 bg-white dark:bg-gray-800 shadow-lg dark:shadow-gray-700/30 rounded-lg sm:rounded-2xl overflow-hidden transition-colors duration-300"
    >
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 p-4 sm:p-6">
            <!-- Columna izquierda - Avatar -->
            <div
                class="flex flex-col items-center justify-center border-b pb-6 md:border-b-0 md:border-r border-gray-200 dark:border-gray-700 md:pr-4 lg:pr-6"
            >
                <div
                    class="w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-3 sm:mb-4 shadow"
                >
                    <svg
                        class="h-12 w-12 sm:h-16 sm:w-16 text-blue-600 dark:text-blue-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        />
                    </svg>
                </div>
                <p
                    class="text-lg sm:text-xl font-semibold text-gray-700 dark:text-gray-200 text-center"
                >
                    {{ form.name }}
                </p>
                <span
                    class="mt-2 inline-block px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium"
                    :class="{
                        'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300':
                            form.role === 'admin',
                        'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300':
                            form.role === 'trainer',
                        'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300':
                            form.role === 'user',
                    }"
                >
                    {{ form.role.charAt(0).toUpperCase() + form.role.slice(1) }}
                </span>
            </div>

            <!-- Columna derecha - Formulario -->
            <div class="md:col-span-2 space-y-3 sm:space-y-4">
                <h2
                    class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100 mb-1 sm:mb-2"
                >
                    Editar entrenador
                </h2>

                <form
                    @submit.prevent="editarEntrenador"
                    class="space-y-3 sm:space-y-4"
                    enctype="multipart/form-data"
                >
                    <!-- Nombre -->
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-600 dark:text-gray-400"
                            >Nombre</label
                        >
                        <input
                            type="text"
                            id="name"
                            v-model="form.name"
                            class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-md sm:rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                        />
                    </div>

                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-600 dark:text-gray-400"
                            >Correo electrónico</label
                        >
                        <input
                            type="email"
                            id="email"
                            v-model="form.email"
                            class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-md sm:rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                        />
                    </div>

                    <!-- Rol -->
                    <div>
                        <label
                            for="role"
                            class="block text-sm font-medium text-gray-600 dark:text-gray-400"
                            >Rol</label
                        >
                        <select
                            id="role"
                            v-model="form.role"
                            class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-md sm:rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                        >
                            <option value="user">Usuario</option>
                            <option value="trainer">Entrenador</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>

                    <!-- Categorías -->
                    <div>
                        <label
                            for="categories"
                            class="block text-sm font-medium text-gray-600 dark:text-gray-400"
                            >Categoría</label
                        >
                        <select
                            id="categories"
                            v-model="form.category"
                            class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-md sm:rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                        >
                            <option value="">Selecciona una categoría</option>
                            <option
                                v-for="cat in categories"
                                :key="cat.name"
                                :value="cat.name"
                            >
                                {{ cat.name }}
                            </option>
                        </select>
                    </div>

                    <!-- Activar/Desactivar -->
                    <div class="flex items-center justify-between">
                        <span
                            class="text-sm font-medium text-gray-600 dark:text-gray-300 mr-3"
                        >
                            Estado del entrenador:
                        </span>
                        <div class="flex items-center">
                            <span
                                class="mr-2 text-sm font-medium text-gray-600 dark:text-gray-300"
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
                                    class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"
                                ></div>
                            </label>
                        </div>
                    </div>

                    <!-- Imagen -->
                    <div>
                        <label
                            for="image"
                            class="block text-sm font-medium text-gray-600 dark:text-gray-400"
                            >Imagen</label
                        >
                        <input
                            type="file"
                            accept="image/*"
                            id="image"
                            @change="onImageChange"
                            class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-md sm:rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                        />
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-600 dark:text-gray-400"
                            >Descripción</label
                        >
                        <textarea
                            id="description"
                            v-model="form.description"
                            rows="4"
                            class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-md sm:rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                        ></textarea>
                    </div>

                    <!-- Tiempo de experiencia -->
                    <div>
                        <label
                            for="experience_time"
                            class="block text-sm font-medium text-gray-600 dark:text-gray-400"
                            >Tiempo de experiencia</label
                        >
                        <input
                            min="0"
                            type="number"
                            id="experience_time"
                            v-model="form.experience_time"
                            class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 dark:border-gray-600 rounded-md sm:rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition"
                        />
                    </div>

                    <!-- Acciones -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center pt-4 sm:pt-6 border-t border-gray-200 dark:border-gray-700 gap-3 sm:gap-0"
                    >
                        <button
                            type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 font-medium shadow-sm transition-colors duration-200"
                        >
                            Guardar cambios
                        </button>
                        <button
                            type="button"
                            @click="
                                () => router.visit(route('admin.trainerAdmin'))
                            "
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-2 rounded-md bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-500 font-medium transition-colors duration-200"
                        >
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, defineProps, onMounted } from "vue";
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

const editarEntrenador = () => {
    if (confirm("¿Seguro que deseas editar este usuario?")) {
        const formData = new FormData();
        
        formData.append('name', form.value.name);
        formData.append('email', form.value.email);
        formData.append('role', form.value.role);
        formData.append('category', form.value.category);
        formData.append('is_active', form.value.is_active ? 1 : 0);
        formData.append('description', form.value.description);
        formData.append('experience_time', form.value.experience_time);
        
        if (form.value.image instanceof File) {
            formData.append('image', form.value.image);
        } else if (form.value.image === null) {
            formData.append('remove_image', 'true');
        }

        // Usar router.post con _method PUT para soportar archivos
        router.post(route('admin.updateTrainer', props.trainer.id), {
            _method: 'PUT',
            ...Object.fromEntries(formData)
        }, {
            onSuccess: () => {
                // Manejar éxito
            },
            onError: (errors) => {
                alert('Error al actualizar: ' + Object.values(errors).join('\n'));
            }
        });
    }
};
const onImageChange = (event) => {
    form.value.image = event.target.files[0];
};

onMounted(() => {
    if (!form.value.category && categories.value.length > 0) {
        form.value.category = categories.value[0].name;
    }
});
</script>
