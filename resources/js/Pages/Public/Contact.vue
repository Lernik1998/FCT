<template>
    <div>
        <!-- Barra de Navegación -->
        <nav class="bg-blue-600 p-4 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">Acerca de nosotros</h1>
                <ul class="flex space-x-6"></ul>
            </div>
        </nav>

        <section class="min-h-screen bg-gray-100 py-12 px-6">
            <div class="max-w-5xl mx-auto">
                <!-- Sección Acerca de Nosotros -->
                <div
                    class="bg-white shadow-lg rounded-lg p-8 mb-12 animate-fade-in"
                >
                    <h1
                        class="text-3xl font-bold text-gray-800 text-center mb-4"
                    >
                        Acerca de Nosotros
                    </h1>
                    <p
                        class="text-gray-600 text-lg text-center leading-relaxed"
                    >
                        Somos un equipo apasionado por brindar soluciones
                        innovadoras en el mundo del fitness y coworking. Nuestro
                        objetivo es ofrecer un espacio donde la productividad y
                        el bienestar se complementan, proporcionando
                        instalaciones de primer nivel y un ambiente
                        colaborativo.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <!-- <img
                            src="https://source.unsplash.com/600x300/?team,fitness"
                            alt="Nuestro equipo"
                            class="rounded-lg shadow-md w-full max-w-lg"
                        /> -->
                    </div>
                </div>

                <!-- Sección de Contacto -->
                <div class="bg-white shadow-lg rounded-lg p-8 animate-slide-in">
                    <h2
                        class="text-3xl font-bold text-gray-800 text-center mb-4"
                    >
                        Contáctanos
                    </h2>
                    <p class="text-gray-600 text-lg text-center mb-6">
                        Si tienes dudas, sugerencias o necesitas asistencia, no
                        dudes en escribirnos. ¡Te responderemos lo antes
                        posible!
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
                                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
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
                                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
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
                                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                                placeholder="Escribe tu mensaje"
                                rows="4"
                                required
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300"
                        >
                            Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Pie de Página -->
    </div>
</template>

<script setup>
import { ref } from "vue";

const form = ref({
    name: "",
    email: "",
    message: "",
});

const submitForm = () => {
    console.log("Mensaje enviado:", form.value);
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
