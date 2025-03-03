<template>
    <section class="min-h-screen bg-gray-100 py-12 px-6 flex justify-center">
        <div
            class="max-w-3xl w-full bg-white shadow-lg rounded-lg p-6 animate-fade-in"
        >
            <!-- Título -->
            <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">
                Editar Actividad
            </h1>

            <!-- Formulario -->
            <form
                @submit.prevent="updateActivity"
                class="space-y-4"
                enctype="multipart/form-data"
            >
                <!-- Nombre -->
                <div>
                    <label class="block text-gray-700 font-semibold"
                        >Nombre de la actividad</label
                    >
                    <input
                        type="text"
                        v-model="activity.name"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300"
                        required
                    />
                </div>

                <!-- Descripción -->
                <div>
                    <label class="block text-gray-700 font-semibold"
                        >Descripción</label
                    >
                    <textarea
                        v-model="activity.description"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300"
                        rows="3"
                        required
                    ></textarea>
                </div>

                <!-- Imagen Actual -->
                <div v-if="activity.image">
                    <label class="block text-gray-700 font-semibold"
                        >Imagen Actual</label
                    >
                    <img
                        :src="activity.image"
                        alt="Imagen actual"
                        class="w-full h-40 object-cover rounded-lg mt-2 shadow"
                    />
                </div>

                <!-- Nueva Imagen -->
                <div>
                    <label class="block text-gray-700 font-semibold"
                        >Nueva Imagen (Opcional)</label
                    >
                    <input
                        type="file"
                        @change="handleFileUpload"
                        accept="image/*"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300"
                    />
                </div>

                <!-- Precio -->
                <div>
                    <label class="block text-gray-700 font-semibold"
                        >Precio</label
                    >
                    <input
                        type="number"
                        v-model="activity.price"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300"
                        required
                    />
                </div>

                <!-- Duración -->
                <div>
                    <label class="block text-gray-700 font-semibold"
                        >Duración</label
                    >
                    <input
                        type="number"
                        v-model="activity.duration"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300"
                        required
                    />
                </div>

                <!-- Fecha -->
                <div>
                    <label class="block text-gray-700 font-semibold"
                        >Fecha</label
                    >
                    <input
                        type="date"
                        v-model="activity.date"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300"
                        required
                    />
                </div>

                <!-- Botón -->
                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition"
                >
                    Actualizar Actividad
                </button>
            </form>

            <!-- Mensaje de éxito -->
            <p
                v-if="successMessage"
                class="mt-4 text-green-600 font-semibold text-center"
            >
                ¡Actividad actualizada exitosamente! 🎉
            </p>
        </div>
    </section>
</template>

<script setup>
import { ref, defineProps } from "vue";
import { router } from "@inertiajs/vue3";

// Recibe la actividad como prop
const props = defineProps({
    activity: Object,
});

// Estado de la actividad con valores precargados
const activity = ref({ ...props.activity });

const successMessage = ref("");

// Manejo de carga de imagen
const handleFileUpload = (event) => {
    activity.value.image = URL.createObjectURL(event.target.files[0]);
};

// Función para actualizar la actividad
const updateActivity = () => {
    console.log("Actividad actualizada:", activity.value);
    successMessage.value = "¡Actividad actualizada exitosamente! 🎉";

    // Enviar datos al controlador
    router.put(
        route("admin.updateActivity", activity.value.id),
        activity.value
    );
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
