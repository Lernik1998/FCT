<template>
    <section class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div
                class="bg-white shadow-xl sm:rounded-lg transition-all hover:shadow-2xl"
            >
                <div class="px-6 py-8 sm:p-10">
                    <!-- Header -->
                    <div class="text-center">
                        <div
                            class="mx-auto h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center mb-6"
                        >
                            <svg
                                class="h-12 w-12 text-blue-600"
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
                        <h1
                            class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-8"
                        >
                            Ficha del Usuario
                        </h1>
                    </div>

                    <!-- Información del usuario -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <p class="text-sm text-gray-500 font-medium">
                                Nombre
                            </p>
                            <p class="text-lg text-gray-800 font-semibold mt-1">
                                {{ user.name }}
                            </p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <p class="text-sm text-gray-500 font-medium">
                                Email
                            </p>
                            <p class="text-lg text-gray-800 mt-1">
                                {{ user.email }}
                            </p>
                        </div>
                        <!-- <div
                            class="bg-gray-50 p-4 rounded-lg border sm:col-span-2"
                            :class="{
                                'bg-blue-100 text-blue-800':
                                    user.role === 'user',
                                'bg-green-100 text-green-800':
                                    user.role === 'admin',
                                'bg-purple-100 text-purple-800':
                                    user.role === 'trainer',
                            }"
                        >
                            <p class="text-sm text-gray-500 font-medium">Rol</p>
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium mt-2"
                            >
                                {{ user.role }}
                            </span>
                        </div> -->
                    </div>

                    <!-- Acciones -->
                    <div class="mt-12 border-t border-gray-200 pt-6">
                        <h2
                            class="text-lg font-semibold text-gray-700 mb-4 text-center"
                        >
                            Acciones
                        </h2>
                        <div
                            class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6"
                        >
                            <a
                                :href="route('admin.editUser', user.id)"
                                class="inline-flex items-center px-6 py-3 rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 text-base font-medium transition"
                            >
                                <svg
                                    class="-ml-1 mr-3 h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>
                                Editar usuario
                            </a>
                            <a
                                :href="route('admin.userAdmin')"
                                class="inline-flex items-center px-6 py-3 rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-100 text-base font-medium border transition"
                            >
                                <svg
                                    class="-ml-1 mr-3 h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                    />
                                </svg>
                                Volver al listado
                            </a>
                        </div>

                        <div class="mt-8 text-center">
                            <button
                                @click="deleteUser(user.id)"
                                class="inline-flex items-center px-6 py-3 rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 text-base font-medium transition"
                            >
                                <svg
                                    class="-ml-1 mr-3 h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    />
                                </svg>
                                Eliminar usuario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({
    user: Object,
});

// Eliminar usuario
const deleteUser = (id) => {
    if (
        confirm("¿Está seguro que desea eliminar este usuario permanentemente?")
    ) {
        router.delete(route("admin.destroyUser", id));
    }
};
</script>
