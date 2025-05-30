<template>
    <Head title="Crear entrenador" />

    <div class="mb-4 mt-10 ml-10">
        <button
            @click="volver"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Volver
        </button>
    </div>

    <section class="py-12 px-6 flex justify-center">
        <div
            class="max-w-4xl w-full bg-white shadow-lg rounded-2xl p-8 animate-fade-in dark:bg-gray-800"
        >
            <h1
                class="text-4xl font-bold text-gray-800 text-center mb-10 dark:text-orange-600"
            >
                Registro de entrenador
            </h1>

            <form
                @submit.prevent="submitForm"
                class="space-y-8"
                enctype="multipart/form-data"
            >
                <!-- Información Básica -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-gray-700 font-semibold mb-1 dark:text-white"
                        >
                            Nombre
                        </label>
                        <input
                            type="text"
                            v-model="trainer.name"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Nombre del entrenador"
                            required
                        />
                    </div>
                    <div>
                        <label
                            class="block text-gray-700 font-semibold mb-1 dark:text-white"
                        >
                            Email
                        </label>
                        <input
                            type="email"
                            v-model="trainer.email"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Correo electrónico"
                            required
                        />
                    </div>
                </div>

                <!-- Credenciales -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-gray-700 font-semibold mb-1 dark:text-white"
                        >
                            Contraseña
                        </label>
                        <input
                            type="password"
                            v-model="trainer.password"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Contraseña"
                            required
                        />
                    </div>
                    <div>
                        <label
                            class="block text-gray-700 font-semibold mb-1 dark:text-white"
                        >
                            Confirmar Contraseña
                        </label>
                        <input
                            type="password"
                            v-model="trainer.password_confirmation"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Repite la contraseña"
                            required
                        />
                    </div>
                </div>

                <!-- Información Profesional -->
                <div>
                    <label
                        class="block text-gray-700 font-semibold mb-1 dark:text-white"
                    >
                        Categoría
                    </label>
                    <select
                        v-model="trainer.category"
                        class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                        required
                    >
                        <option value="">Seleccionar categoría</option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.name"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <div>
                    <label
                        class="block text-gray-700 font-semibold mb-1 dark:text-white"
                    >
                        Descripción Profesional
                    </label>
                    <textarea
                        v-model="trainer.description"
                        class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                        placeholder="Experiencia, formación, metodología..."
                        rows="4"
                        required
                    ></textarea>
                </div>

                <!-- Imagen -->
                <div>
                    <label
                        class="block text-gray-700 font-semibold mb-1 dark:text-white"
                    >
                        Foto de perfil
                    </label>
                    <input
                        type="file"
                        @change="handleFileUpload"
                        accept="image/*"
                        ref="fileInput"
                        class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                        required
                    />
                </div>

                <!-- Tiempo experiencia -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-gray-700 font-semibold mb-1 dark:text-white"
                        >
                            Tiempo de experiencia
                        </label>
                        <input
                            type="number"
                            v-model="trainer.experience_time"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Tiempo de experiencia"
                            required
                        />
                    </div>
                </div>

                <!-- Botón -->
                <div>
                    <button
                        type="submit"
                        class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition font-semibold text-lg"
                    >
                        Registrar
                    </button>
                </div>
            </form>
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
    trainer.value.image = event.target.files[0];
};

// Estado del entrenador
const trainer = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    category: "",
    description: "",
    image: "",
    experience_time: "",
});

// Función para enviar formulario
const submitForm = () => {
    console.log("Entrenador creado:", trainer.value);
    router.post(route("admin.createTrainer"), trainer.value);
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
