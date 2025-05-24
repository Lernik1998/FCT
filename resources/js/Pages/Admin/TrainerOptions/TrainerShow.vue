<template>
    <section
        class="min-h-screen py-8 md:py-12 px-4 sm:px-6 lg:px-8 dark:bg-gray-900 transition-colors duration-300"
    >
        <div class="max-w-4xl mx-auto">
            <h2
                class="mb-6 md:mb-8 font-bold text-xl sm:text-2xl text-orange-600 dark:text-orange-500"
            >
                Ficha del entrenador
            </h2>

            <div
                class="bg-white dark:bg-gray-800 shadow-lg sm:shadow-xl rounded-lg sm:rounded-2xl overflow-hidden transition-all hover:shadow-xl dark:hover:shadow-gray-700/50"
            >
                <div
                    class="flex flex-col sm:flex-row p-6 sm:p-8 gap-6 sm:gap-8"
                >
                    <!-- Avatar Section -->
                    <div
                        class="flex flex-col items-center sm:items-start sm:w-1/3"
                    >
                        <div
                            class="h-20 w-20 sm:h-28 sm:w-28 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-3 sm:mb-4 overflow-hidden"
                        >
                            <img
                                :src="
                                    trainer.image
                                        ? '/images/trainers/' + trainer.image
                                        : '/images/default-avatar.jpg'
                                "
                                :alt="trainer.name"
                                class="h-full w-full object-cover"
                            />
                        </div>
                        <div class="text-center sm:text-left">
                            <h2
                                class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white"
                            >
                                {{ trainer.name }}
                            </h2>
                            <p
                                class="text-sm text-gray-600 dark:text-gray-300 mt-1"
                                :class="
                                    trainer.is_active
                                        ? 'text-green-600 dark:text-green-400'
                                        : 'text-red-600 dark:text-red-400'
                                "
                            >
                                {{ trainer.is_active ? "Activo" : "Inactivo" }}
                            </p>
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div
                        class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6"
                    >
                        <div>
                            <p
                                class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium"
                            >
                                Email
                            </p>
                            <p
                                class="text-base sm:text-lg text-gray-800 dark:text-gray-100 font-semibold mt-1 break-all"
                            >
                                {{ trainer.email }}
                            </p>
                        </div>
                        <div>
                            <p
                                class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium"
                            >
                                Categoría
                            </p>
                            <span
                                class="inline-flex items-center px-3 py-1 sm:px-4 sm:py-2 mt-1 rounded-full text-xs sm:text-sm font-medium dark:bg-orange-700 dark:text-orange-100"
                                :class="{
                                    'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300':
                                        trainer.category === 'user',
                                    'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300':
                                        trainer.category === 'admin',
                                    'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300':
                                        trainer.category === 'trainer',
                                }"
                            >
                                {{
                                    trainer.category
                                        ? trainer.category
                                        : "Sin categoría"
                                }}
                            </span>
                        </div>

                        <!-- Tiempo experiencia -->
                        <div>
                            <p
                                class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium"
                            >
                                Tiempo experiencia
                            </p>
                            <p
                                class="text-base sm:text-lg text-gray-800 dark:text-gray-100 font-semibold mt-1"
                            >
                                {{
                                    trainer.experience_time || "No especificado"
                                }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Descripción Expandida -->
                <div
                    class="border-t border-gray-200 dark:border-gray-700 px-6 sm:px-8 py-4 sm:py-6"
                >
                    <p
                        class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mb-2"
                    >
                        Descripción
                    </p>
                    <div class="prose dark:prose-invert max-w-none">
                        <template
                            v-if="
                                trainer.description &&
                                trainer.description.trim() !== ''
                            "
                        >
                            <p
                                class="text-gray-800 dark:text-gray-200 whitespace-pre-line"
                            >
                                {{ trainer.description }}
                            </p>
                        </template>
                        <template v-else>
                            <p class="text-gray-500 dark:text-gray-400 italic">
                                Sin descripción
                            </p>
                        </template>
                    </div>
                </div>

                <!-- Actions -->
                <div
                    class="border-t border-gray-200 dark:border-gray-700 px-6 sm:px-8 py-4 sm:py-6 bg-gray-50 dark:bg-gray-700/30"
                >
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-4"
                    >
                        <div
                            class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto"
                        >
                            <a
                                :href="route('admin.editTrainer', trainer.id)"
                                class="inline-flex items-center justify-center px-4 py-2 sm:px-5 sm:py-2.5 rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-sm sm:text-base font-medium transition w-full sm:w-auto"
                            >
                                <svg
                                    class="-ml-1 mr-2 h-4 w-4 sm:h-5 sm:w-5"
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
                                Editar
                            </a>

                            <a
                                :href="route('admin.trainerAdmin')"
                                class="inline-flex items-center justify-center px-4 py-2 sm:px-5 sm:py-2.5 rounded-md shadow-sm text-gray-700 dark:text-gray-300 bg-white hover:bg-gray-100 dark:bg-gray-600 dark:hover:bg-gray-500 text-sm sm:text-base font-medium border dark:border-gray-600 transition w-full sm:w-auto"
                            >
                                <svg
                                    class="-ml-1 mr-2 h-4 w-4 sm:h-5 sm:w-5"
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
                                Volver
                            </a>
                        </div>

                        <button
                            @click="deleteTrainer(trainer.id)"
                            class="inline-flex items-center justify-center px-4 py-2 sm:px-5 sm:py-2.5 rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 text-sm sm:text-base font-medium transition w-full sm:w-auto mt-2 sm:mt-0"
                        >
                            <svg
                                class="-ml-1 mr-2 h-4 w-4 sm:h-5 sm:w-5"
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
                            Eliminar
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
