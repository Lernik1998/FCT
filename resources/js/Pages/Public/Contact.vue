<template>
    <!-- Muestro mensaje de exito o error -->
    <section class="p-8 ml-32">
        <div
            v-if="message"
            class="p-4 mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700"
        >
            {{ message }}
        </div>
    </section>

    <section class="py-12 px-6">
        <div class="max-w-5xl mx-auto">
            <!-- Sección Acerca de Nosotros -->
            <div
                class="bg-white shadow-lg rounded-lg p-8 mb-12 animate-fade-in transition-transform transform hover:scale-105 hover:shadow-2xl"
            >
                <h1 class="text-3xl font-bold text-gray-900 text-center mb-4">
                    Acerca de Nosotros
                </h1>
                <p
                    class="text-gray-600 dark:text-gray-900 text-lg text-center leading-relaxed"
                >
                    FitWorking es un centro fitness moderno y accesible que
                    promueve un estilo de vida activo y saludable. Contamos con
                    instalaciones de última generación, entrenadores
                    cualificados y un ambiente motivador para personas de todas
                    las edades. Aquí no solo entrenas, también formas parte de
                    una comunidad que comparte tus objetivos de bienestar.
                </p>

                <div class="mt-6 flex justify-center">
                    <img
                        src="../../../../public/ownImages/comunidad.jpg"
                        alt="Nuestro equipo"
                        class="rounded-lg shadow-md w-full max-w-lg"
                    />
                </div>
            </div>

            <!-- Sección de Contacto -->
            <div class="bg-white shadow-lg rounded-lg p-8 animate-slide-in">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-4">
                    Contáctanos
                </h2>
                <p
                    class="text-gray-600 dark:text-gray-900 text-lg text-center mb-6"
                >
                    Si tienes dudas, sugerencias o necesitas asistencia, no
                    dudes en escribirnos. ¡Te responderemos lo antes posible!
                </p>

                <form @submit.prevent="submitForm" class="space-y-4">
                    <div>
                        <label
                            for="name"
                            class="block text-gray-700 font-medium"
                            >Nombre</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            id="name"
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:text-black"
                            placeholder="Tu nombre"
                            required
                        />
                    </div>

                    <div>
                        <label
                            for="email"
                            class="block text-gray-700 font-medium"
                            >Correo Electrónico</label
                        >
                        <input
                            v-model="form.email"
                            type="email"
                            id="email"
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:text-black"
                            placeholder="Tu correo"
                            required
                        />
                    </div>

                    <div>
                        <label
                            for="message"
                            class="block text-gray-700 font-medium"
                            >Mensaje</label
                        >
                        <textarea
                            v-model="form.message"
                            id="message"
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:text-black"
                            placeholder="Escribe tu mensaje"
                            rows="4"
                            required
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-gray-500 text-white dark:bg-orange-500 dark:text-black py-2 rounded-lg hover:bg-green-600 transition duration-300"
                    >
                        Enviar mensaje
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Modal de Confirmación -->
    <ConfirmationModal
        :show="confirModal"
        @close="confirModal = false"
        :max-width="'2xl'"
        :closeable="true"
        :title="'Mensaje enviado con éxito'"
        :content="'El mensaje ha sido enviado correctamente'"
        :footer="'Haga click fuera de la casilla para cerrar'"
    />
    <!-- Pie de Página -->
    <OutTeam />
</template>

<script setup>
// Importaciones
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

// Componentes
import NavBar from "../Public/Components/NavBar.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import OutTeam from "./Components/OurTeam.vue";

// Variables
const form = ref({
    name: "",
    email: "",
    message: "",
});

const confirModal = ref(false);

// Funciones
const submitForm = () => {
    // Envio al servidor los datos -- IMPLEMENTAR PROTECCIÓN CSRF , VALIDACIÓN DE DATOS E INYECCIÓN DE SCRIPTS
    // router.post(route("admin.unregisteredUserMessage"), form.value);
    router.post(route("admin.unregisteredUserMessage"), form.value);

    // Mostrar el modal de confirmación
    confirModal.value = true;

    console.log("Valor de confirModal.value: ", confirModal.value);

    // Limpiamos el formulario
    form.value = {
        name: "",
        email: "",
        message: "",
    };
};

// Recibo el mensaje de exito o error
const props = defineProps(["message"]);
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

@keyframes slide-in {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-slide-in {
    animation: slide-in 0.6s ease-out;
}
</style>
