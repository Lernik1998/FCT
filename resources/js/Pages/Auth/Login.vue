<template>
    <Head title="Iniciar sesión" />

    <!-- Fondo con gradiente y elementos decorativos -->
    <div class="min-h-screen bg-gradient-to-br flex flex-col">
        <!-- Botón de volver -->
        <div class="pt-6 pl-6">
            <Link
                :href="route('index')"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:ring-offset-gray-900"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
                Volver
            </Link>
        </div>

        <!-- Contenedor principal -->
        <div
            class="flex flex-col items-center justify-center px-4 py-12 sm:px-6 lg:px-8 flex-grow"
        >
            <!-- Tarjeta de login -->
            <div
                class="w-full max-w-md bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-gray-700"
            >
                <!-- Encabezado con gradiente -->
                <div
                    class="bg-gradient-to-r from-orange-500 to-amber-600 p-6 text-center"
                >
                    <h2 class="text-3xl font-extrabold text-white">
                        FitWorking
                    </h2>
                    <p class="mt-2 text-amber-100">
                        Accede a tu cuenta para comenzar
                    </p>
                </div>

                <!-- Formulario -->
                <div class="px-8 py-8 bg-gray-800">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel
                                for="email"
                                value="Correo electrónico"
                                class="text-gray-300"
                            />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
                                autofocus
                                autocomplete="username"
                            />
                            <!--  required -->
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <div>
                            <InputLabel
                                for="password"
                                value="Contraseña"
                                class="text-gray-300"
                            />
                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full bg-gray-700 text-white border-gray-600 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
                                autocomplete="current-password"
                            />
                            <!--  required -->
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <Checkbox
                                    v-model:checked="form.remember"
                                    name="remember"
                                    class="mr-2 text-orange-500 focus:ring-orange-500 border-gray-600"
                                />
                                <span class="text-sm text-gray-300"
                                    >Recordarme</span
                                >
                            </div>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-orange-400 hover:text-orange-300 hover:underline"
                            >
                                ¿Olvidó su contraseña?
                            </Link>
                        </div>

                        <PrimaryButton
                            class="mt-4 w-full bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 focus:ring-offset-gray-800"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Iniciar sesión
                        </PrimaryButton>

                        <GoogleLogin class="mt-4" />

                        <div class="text-center">
                            <Link
                                :href="route('register')"
                                class="text-sm text-orange-400 hover:text-orange-300 hover:underline"
                            >
                                ¿No tienes una cuenta? Regístrate
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// Importaciones
import { Head, Link, useForm } from "@inertiajs/vue3";

// Componentes
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import GoogleLogin from "@/Components/GoogleLogin.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>
