<template>
    <!-- Navbar Trainer -->
    <nav class="p-4 border-b shadow-md bg-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Marina Alta Deportes</div>
            <TrainersNavBar />
        </div>
    </nav>

    <!-- Botón para volver -->
    <div class="mt-10 ml-10">
        <button
            @click="volver"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
        >
            Volver
        </button>
    </div>
    <section class="min-h-screen py-12 px-6 flex justify-center">
        <div
            class="max-w-3xl w-full bg-white shadow-lg rounded-lg p-6 animate-fade-in"
        >
            <!-- Título -->
            <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">
                Crear Nueva Actividad
            </h1>

            <!-- Formulario -->
            <form
                @submit.prevent="submitForm"
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
                        placeholder="Ej. CrossFit, Yoga, Spinning..."
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
                        placeholder="Describe la actividad..."
                        rows="3"
                        required
                    ></textarea>
                </div>

                <!-- Imagen -->
                <div>
                    <label class="block text-gray-700 font-semibold"
                        >Imagen</label
                    >
                    <input
                        type="file"
                        @change="handleFileUpload"
                        accept="image/*"
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300"
                        required
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
                    class="w-full bg-gray-500 text-white py-2 rounded-lg hover:bg-blue-600 transition"
                >
                    Crear Actividad
                </button>
            </form>

            <!-- Mensaje de éxito -->
            <p
                v-if="successMessage"
                class="mt-4 text-green-600 font-semibold text-center"
            >
                ¡Actividad creada exitosamente! 🎉
            </p>
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

// Componentes
import TrainersNavBar from "../Components/TrainersNavBar.vue";

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
