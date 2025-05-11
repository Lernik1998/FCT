<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
// import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Registro" />

    <div
        class="mt-20 flex items-center justify-center dark:bg-gray-900 px-4 sm:px-6 lg:px-8"
    >
        <div
            class="w-full max-w-md bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-md space-y-6"
        >
            <!-- Logo opcional -->
            <!-- <div class="flex justify-center">
                <AuthenticationCardLogo />
            </div> -->

            <h2
                class="text-center text-2xl font-bold text-gray-900 dark:text-white"
            >
                Unete a
                <span class="text-orange-600 dark:text-orange-400"
                    >FitWorking</span
                >
            </h2>

            <form @submit.prevent="submit" class="space-y-5">
                <div>
                    <InputLabel for="name" value="Nombre" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="Correo electrónico" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
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
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel
                        for="password_confirmation"
                        value="Confirmar contraseña"
                    />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div
                    v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                >
                    <div class="flex items-center">
                        <Checkbox
                            id="terms"
                            v-model:checked="form.terms"
                            name="terms"
                            required
                        />
                        <label
                            for="terms"
                            class="ml-2 text-sm text-gray-600 dark:text-gray-300"
                        >
                            Acepto los
                            <a
                                target="_blank"
                                :href="route('terms.show')"
                                class="underline hover:text-gray-900 dark:hover:text-gray-100"
                                >Términos de servicio</a
                            >
                            y la
                            <a
                                target="_blank"
                                :href="route('policy.show')"
                                class="underline hover:text-gray-900 dark:hover:text-gray-100"
                                >Política de privacidad</a
                            >
                        </label>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </div>

                <div class="flex items-center justify-between">
                    <Link
                        :href="route('login')"
                        class="text-sm underline text-orange-600 dark:text-orange-400 hover:text-gray-900 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        ¿Ya tienes cuenta?
                    </Link>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Registrar
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
