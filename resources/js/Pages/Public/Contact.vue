<template>
    <Head title="Contacto" />

    <!-- Success message -->
    <section class="p-4 md:p-8 md:ml-0 lg:ml-32">
        <div
            v-if="message === true"
            class="p-4 mb-4 rounded-lg bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-100"
        >
            {{ $t("pages.Contact.about_page.messages.success") }}
        </div>
    </section>

    <!-- Error message -->
    <section class="p-4 md:p-8 md:ml-0 lg:ml-32">
        <div
            v-if="message === false"
            class="p-4 mb-4 rounded-lg bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-100"
        >
            {{ $t("pages.Contact.about_page.messages.error") }}
        </div>
    </section>

    <section class="py-8 md:py-12 px-4 sm:px-6">
        <div class="max-w-5xl mx-auto">
            <!-- About Us Section -->
            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 md:p-8 mb-8 md:mb-12 animate-fade-in transition-transform transform hover:scale-[1.01] hover:shadow-xl dark:hover:shadow-gray-700/50"
            >
                <h1
                    class="text-2xl md:text-3xl font-bold text-orange-600 dark:text-orange-500 text-center mb-4"
                >
                    {{ $t("pages.Contact.about_page.about_section.title") }}
                </h1>
                <p
                    class="text-gray-900 dark:text-gray-300 text-base md:text-lg text-center leading-relaxed"
                >
                    {{ $t("pages.Contact.about_page.about_section.content") }}
                </p>

                <div class="mt-6 flex justify-center">
                    <img
                        src="../../../../public/ownImages/comunidad.jpg"
                        alt="Nuestro equipo"
                        class="rounded-lg shadow-md w-full max-w-lg"
                        loading="lazy"
                    />
                </div>
            </div>

            <!-- Contact Section -->
            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 md:p-8 animate-slide-in"
            >
                <h2
                    class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-orange-600 text-center mb-4"
                >
                    {{ $t("pages.Contact.about_page.contact_section.title") }}
                </h2>
                <p
                    class="text-gray-600 dark:text-gray-300 text-base md:text-lg text-center mb-6"
                >
                    {{ $t("pages.Contact.about_page.contact_section.description") }}
                </p>

                <form @submit.prevent="submitForm" class="space-y-4">
                    <div>
                        <label
                            for="name"
                            class="block text-gray-700 dark:text-gray-300 font-medium"
                            >Nombre</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            id="name"
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                            placeholder="Tu nombre"
                            required
                        />
                    </div>

                    <div>
                        <label
                            for="email"
                            class="block text-gray-700 dark:text-gray-300 font-medium"
                            >Correo Electrónico</label
                        >
                        <input
                            v-model="form.email"
                            type="email"
                            id="email"
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                            placeholder="Tu correo"
                            required
                        />
                    </div>

                    <div>
                        <label
                            for="message"
                            class="block text-gray-700 dark:text-gray-300 font-medium"
                            >Mensaje</label
                        >
                        <textarea
                            v-model="form.message"
                            id="message"
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:focus:ring-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                            placeholder="Escribe tu mensaje"
                            rows="4"
                            required
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-gray-500 text-white dark:bg-orange-600 dark:text-white py-2 rounded-lg hover:bg-gray-600 dark:hover:bg-orange-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-orange-500"
                    >
                        {{ $t("pages.Contact.about_page.contact_section.form.submit") }}
                    </button>
                </form>
            </div>
        </div>
    </section>

    <OutTeam />
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import OutTeam from "./Components/OurTeam.vue";

// Recibo el mensaje de exito o error
const props = defineProps(["message"]);

// Variables
const form = ref({
    name: "",
    email: "",
    message: "",
});

// Funciones
const submitForm = () => {
    // Envio al servidor los datos
    router.post(route("admin.unregisteredUserMessage"), form.value);

    // Limpiamos el formulario
    form.value = {
        name: "",
        email: "",
        message: "",
    };
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
