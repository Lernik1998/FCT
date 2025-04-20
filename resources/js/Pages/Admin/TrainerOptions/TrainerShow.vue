<template>
    <section class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <h2 class="mb-8 font-bold text-2xl">Ficha del Usuario</h2>

        <div class="max-w-4xl mx-auto">
            <div
                class="bg-white shadow-xl rounded-2xl overflow-hidden transition-all hover:shadow-2xl"
            >
                <div class="flex flex-col sm:flex-row p-8 gap-8">
                    <div
                        class="flex flex-col items-center sm:items-start sm:w-1/3"
                    >
                        <div
                            class="h-28 w-28 rounded-full bg-blue-100 flex items-center justify-center mb-4"
                        >
                            <svg
                                class="h-14 w-14 text-blue-600"
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
                        <h2
                            class="text-xl font-semibold text-gray-800 text-center sm:text-left"
                        >
                            {{ trainer.name }}
                        </h2>
                    </div>

                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">
                                Email
                            </p>
                            <p class="text-lg text-gray-800 font-semibold mt-1">
                                {{ trainer.email }}
                            </p>
                        </div>
                        <div class="ml-10">
                            <p class="text-sm text-gray-500 font-medium">
                                Categoría
                            </p>
                            <span
                                class="inline-flex items-center px-4 py-2 mt-1 rounded-full text-sm font-medium"
                            >
                                <!-- :class="{
                                    'bg-blue-100 text-blue-800':
                                        trainer.category === 'user',
                                    'bg-green-100 text-green-800':
                                        trainer.category === 'admin',
                                    'bg-purple-100 text-purple-800':
                                        trainer.category === 'trainer',
                                }" -->
                                {{ trainer.category }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-gray-200 px-8 py-6 bg-gray-50">
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center gap-4"
                    >
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a
                                :href="route('admin.editTrainer', trainer.id)"
                                class="inline-flex items-center px-5 py-2.5 rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 text-base font-medium transition"
                            >
                                <svg
                                    class="-ml-1 mr-2 h-5 w-5"
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
                                Editar entrenador
                            </a>

                            <a
                                :href="route('admin.userAdmin')"
                                class="inline-flex items-center px-5 py-2.5 rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-100 text-base font-medium border transition"
                            >
                                <svg
                                    class="-ml-1 mr-2 h-5 w-5"
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

                        <button
                            @click="deleteTrainer(trainer.id)"
                            class="inline-flex items-center px-5 py-2.5 rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 text-base font-medium transition"
                        >
                            <svg
                                class="-ml-1 mr-2 h-5 w-5"
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
    </section>
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({
    trainer: Object,
});

// Eliminar usuario
const deleteTrainer = (id) => {
    if (
        confirm("¿Está seguro que desea eliminar este usuario permanentemente?")
    ) {
        router.delete(route("admin.destroyUser", id));
    }
};
</script>
