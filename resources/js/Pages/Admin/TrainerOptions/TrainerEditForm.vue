<template>
    <section
        class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-2xl overflow-hidden"
    >
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <div
                class="flex flex-col items-center justify-center border-r md:border-r border-gray-200 pr-4 md:pr-6"
            >
                <div
                    class="w-32 h-32 rounded-full bg-blue-100 flex items-center justify-center mb-4 shadow"
                >
                    <svg
                        class="h-16 w-16 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        />
                    </svg>
                </div>
                <p class="text-xl font-semibold text-gray-700 text-center">
                    {{ name }}
                </p>
                <span
                    class="mt-2 inline-block px-3 py-1 rounded-full text-sm font-medium"
                    :class="{
                        'bg-green-100 text-green-800': role === 'admin',
                        'bg-blue-100 text-blue-800': role === 'trainer',
                        'bg-gray-100 text-gray-800': role === 'user',
                    }"
                >
                    {{ role.charAt(0).toUpperCase() + role.slice(1) }}
                </span>
            </div>

            <!-- Formulario a la derecha -->
            <div class="md:col-span-2 space-y-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Editar entrenador
                </h2>

                <form @submit.prevent="editarEntrenador" class="space-y-4">
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-600"
                            >Nombre</label
                        >
                        <input
                            type="text"
                            id="name"
                            v-model="name"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>

                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-600"
                            >Correo electrónico</label
                        >
                        <input
                            type="email"
                            id="email"
                            v-model="email"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>

                    <div>
                        <label
                            for="role"
                            class="block text-sm font-medium text-gray-600"
                            >Rol</label
                        >
                        <select
                            id="role"
                            v-model="role"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="user">Usuario</option>
                            <option value="trainer">Entrenador</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>

                    <!-- Categorías -->

                    <div>
                        <label
                            for="categories"
                            class="block text-sm font-medium text-gray-600"
                            >Categorías</label
                        >

                        <select
                            id="categories"
                            v-model="category"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">Selecciona una categoría</option>
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <!-- Activar (Estado) -->
                    <div>
                        <label
                            for="active"
                            class="block text-sm font-medium text-gray-600"
                            >Activar</label
                        >
                        <input
                            type="checkbox"
                            id="active"
                            v-model="active"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>

                    <!-- Asignar categoria para acceso del calendario -->
                    <div>
                        <p class="text-gray-600">
                            Pendiente gestión de asignación de categorias para
                            enlazar con el Calendario a mostrar en el Trainer
                        </p>
                    </div>

                    <!-- Acciones -->
                    <div
                        class="flex justify-between items-center pt-6 border-t border-gray-200"
                    >
                        <button
                            type="submit"
                            class="inline-flex items-center px-6 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 font-medium shadow-sm transition"
                        >
                            Guardar cambios
                        </button>
                        <button
                            type="button"
                            @click="
                                () => router.visit(route('admin.trainerAdmin'))
                            "
                            class="inline-flex items-center px-6 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium transition"
                        >
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, defineProps } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({
    trainer: Object,
    categories: Array,
});

const categories = ref(props.categories);

const name = ref(props.trainer.name);
const email = ref(props.trainer.email);
const role = ref(props.trainer.role);
const category = ref(props.trainer.category);
const active = ref(props.trainer.active);

const editarEntrenador = () => {
    if (
        name.value === props.trainer.name &&
        email.value === props.trainer.email &&
        role.value === props.trainer.role
    ) {
        return alert("No se ha hecho ninguna modificación");
    }

    if (confirm("¿Seguro que deseas editar este usuario?")) {
        router.put(route("admin.updateTrainer", props.trainer.id), {
            name: name.value,
            email: email.value,
            role: role.value,
            category: category.value,
            active: active.value,
        });
    }
};
</script>
