<template>
    <section class="flex justify-center p-4 sm:p-6 dark:bg-gray-900">
        <div
            class="dark:bg-gray-800 shadow-lg rounded-lg p-6 w-full max-w-md animate-fade-in"
        >
            <h1
                class="text-2xl font-bold text-gray-800 dark:text-white mb-4 text-center"
            >
                Crear Usuario
            </h1>
            <form @submit.prevent="crearUsuario" class="space-y-4">
                <!-- Nombre -->
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
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                        placeholder="Introduce el nombre"
                        required
                    />
                </div>

                <!-- Correo Electrónico -->
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
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                        placeholder="Introduce el correo"
                        required
                    />
                </div>

                <!-- Contraseña -->
                <div>
                    <label
                        for="password"
                        class="block text-gray-700 dark:text-gray-300 font-medium"
                        >Contraseña</label
                    >
                    <input
                        v-model="form.password"
                        type="password"
                        id="password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                        placeholder="Introduce la contraseña"
                        required
                    />
                </div>

                <!-- Rol -->
                <div>
                    <label
                        for="role"
                        class="block text-gray-700 dark:text-gray-300 font-medium"
                        >Rol</label
                    >
                    <select
                        v-model="form.role"
                        id="role"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    >
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                        <option value="trainer">Entrenador</option>
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button
                        type="submit"
                        class="w-full bg-green-500 dark:bg-green-600 text-white py-2 rounded-lg hover:bg-green-600 dark:hover:bg-green-700 transition duration-300"
                    >
                        Crear Usuario
                    </button>
                    <a
                        :href="route('admin.userAdmin')"
                        class="w-full bg-blue-500 dark:bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-600 dark:hover:bg-blue-700 transition duration-300 text-center"
                    >
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const form = ref({
    name: "",
    email: "",
    password: "",
    role: "user",
});

const crearUsuario = () => {
    if (
        form.value.name === "" ||
        form.value.email === "" ||
        form.value.password === "" ||
        form.value.role === ""
    ) {
        return alert("Por favor, complete todos los campos");
    }

    if (confirm("¿Seguro que deseas crear este usuario?")) {
        router.post(route("admin.createUser"), form.value);
    }
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
