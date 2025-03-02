<template>
    <Head title="Iniciar sesión" />
    <div class="mt-10">
        <Link
            :href="route('index')"
            class="px-4 py-2 ml-72 text-white bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 focus:ring-offset-gray-100"
        >
            Volver
        </Link>
    </div>
    <div
        class="container mx-auto p-4 flex flex-col items-center justify-center h-screen"
    >
        <div class="rounded-lg shadow-lg p-8 w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
            <h2 class="text-3xl font-bold text-center">Iniciar sesión</h2>

            <form @submit.prevent="submit" class="mt-8 space-y-6">
                <div>
                    <InputLabel for="email" value="Correo electrónico" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" value="Contraseña" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-ye-500 focus:border-ye-500"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <Checkbox
                            v-model:checked="form.remember"
                            name="remember"
                            class="mr-2"
                        />
                        <span class="text-sm">Recordarme</span>
                    </div>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm hover:text-gray-900 hover:underline"
                    >
                        ¿Olvidó su contraseña?
                    </Link>
                </div>

                <PrimaryButton
                    class="mt-4 w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Iniciar sesión
                </PrimaryButton>

                <GoogleLogin class="mt-4" />
                <!-- Link para ir al registro -->

                <br />
                <Link
                    :href="route('register')"
                    class="mt-4 w-full text-center text-sm hover:text-gray-900 hover:underline"
                >
                    ¿No tienes una cuenta? Registrate
                </Link>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
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
