<template>
    <Head title="Iniciar sesión" />

    <div
        class="flex flex-col items-center justify-center px-4 py-12 sm:px-6 lg:px-8 flex-grow bg-white dark:bg-gray-900"
    >
        <div
            class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden"
        >
            <!-- Encabezado -->
            <div class="bg-gradient-to-r p-6 text-center">
                <h2 class="text-3xl font-extrabold text-orange-600">
                    FitWorking
                </h2>
                <p class="mt-2 text-gray-700 dark:text-gray-300">
                    Accede a tu cuenta para comenzar
                </p>
            </div>

            <!-- Formulario -->
            <div class="px-8 py-8">
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Email -->
                    <div>
                        <InputLabel
                            for="email"
                            value="Correo electrónico"
                            class="text-gray-700 dark:text-white"
                        />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <InputLabel
                            for="password"
                            value="Contraseña"
                            class="text-gray-700 dark:text-white"
                        />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
                            autocomplete="current-password"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>

                    <!-- Recordarme + link -->
                    <div class="flex items-center justify-between">
                        <label
                            class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300"
                        >
                            <Checkbox
                                v-model:checked="form.remember"
                                name="remember"
                                class="text-orange-500 focus:ring-orange-500 border-gray-300 dark:border-gray-600"
                            />
                            <span class="text-gray-700 dark:text-gray-300"
                                >Recordarme</span
                            >
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm text-gray-700 hover:text-orange-400 dark:hover:text-amber-300 hover:underline dark:text-orange-700"
                        >
                            ¿Olvidó su contraseña?
                        </Link>
                    </div>

                    <!-- Botón de login -->
                    <PrimaryButton
                        class="mt-4 w-full bg-gradient-to-r hover:from-orange-600 hover:to-amber-700 text-white flex items-center justify-center focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        <span class="mx-auto">Iniciar sesión</span>
                    </PrimaryButton>

                    <!-- Login con Google -->
                    <GoogleLogin class="mt-4" />

                    <!-- Registro -->
                    <!-- <div class="text-center">
                        <Link
                            :href="route('register')"
                            class="text-sm text-gray-700 hover:text-orange-400 dark:hover:text-amber-300 hover:underline"
                        >
                            ¿No tienes una cuenta? Regístrate
                        </Link>
                    </div> -->

                    <!-- Registro -->
                    <div class="text-center text-sm">
                        <Link
                            :href="route('register')"
                            class="font-medium text-amber-600 hover:text-amber-500 dark:text-amber-400 dark:hover:text-orange-700 transition-colors duration-200"
                        >
                            ¿No tienes una cuenta? Regístrate
                        </Link>
                    </div>
                </form>
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
