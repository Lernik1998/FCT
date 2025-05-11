<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    status: String,
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <Head title="Olvidaste tu contraseña" />

    <div
        class="mt-20 flex items-center justify-center  dark:bg-gray-900 px-4 sm:px-6 lg:px-8"
    >
        <div
            class="w-full max-w-md space-y-6 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 sm:p-8"
        >
            <!-- Logo opcional -->
            <!-- <div class="flex justify-center">
                <AuthenticationCardLogo />
            </div> -->

            <h2
                class="text-center text-2xl font-bold text-orange-600 dark:text-white"
            >
                ¿Olvidaste tu contraseña?
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                No hay problema. Solo indícanos tu dirección de correo
                electrónico y te enviaremos un enlace para restablecer la
                contraseña que te permitirá elegir una nueva.
            </p>

            <div
                v-if="status"
                class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-center"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="email" value="Correo electrónico"  class="text-gray-700 dark:text-orange-600"
                    />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="flex justify-end">
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        class="w-full sm:w-auto"
                    >
                        Enviar enlace para restablecer contraseña
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
