<template>
    <div class="mb-4 mt-10 ml-10">
        <button
            @click="volver"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Volver
        </button>
    </div>

    <section class="py-12 px-6 flex justify-center">
        <div class="max-w-4xl w-full bg-white shadow-lg rounded-2xl p-8 animate-fade-in">
            <h1 class="text-4xl font-bold text-gray-800 text-center mb-10">
                Crear Nueva Actividad
            </h1>

            <form @submit.prevent="submitForm" class="space-y-8" enctype="multipart/form-data">
                <!-- Nombre y Precio -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">
                            Nombre de la actividad
                        </label>
                        <input
                            type="text"
                            v-model="activity.name"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Ej. CrossFit, Yoga, Spinning..."
                            required
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">
                            Precio (€)
                        </label>
                        <input
                            type="number"
                            v-model="activity.price"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Precio en euros"
                            required
                        />
                    </div>
                </div>

                <!-- Descripción -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">
                        Descripción
                    </label>
                    <textarea
                        v-model="activity.description"
                        class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                        placeholder="Describe la actividad..."
                        rows="4"
                        required
                    ></textarea>
                </div>

                <!-- Imagen -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">
                        Imagen
                    </label>
                    <input
                        type="file"
                        @change="handleFileUpload"
                        accept="image/*"
                        class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                        required
                    />
                </div>

                <!-- Fecha y Horario -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">
                            Fecha
                        </label>
                        <input
                            type="date"
                            v-model="activity.date"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            required
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">
                            Hora inicio
                        </label>
                        <input
                            type="time"
                            v-model="activity.start_time"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            required
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">
                            Hora fin
                        </label>
                        <input
                            type="time"
                            v-model="activity.end_time"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            required
                        />
                    </div>
                </div>

                <!-- Categoría -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">
                        Categoría
                    </label>
                    <select
                        v-model="activity.category_id"
                        class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                        required
                    >
                        <option value="" disabled>Selecciona una categoría</option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <!-- Botón -->
                <div>
                    <button
                        type="submit"
                        class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition font-semibold text-lg"
                    >
                        Crear Actividad
                    </button>
                </div>
            </form>

            <!-- Mensaje de éxito -->
            <p v-if="successMessage" class="mt-6 text-green-600 font-semibold text-center text-xl">
                ¡Actividad creada exitosamente! 🎉
            </p>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

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
    router.post(route("admin.storeActivity"), activity.value);
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
