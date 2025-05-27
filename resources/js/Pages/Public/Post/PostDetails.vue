<template>
    <section class="min-h-screen dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Botón de volver -->
        <button
            @click="() => router.visit(route('posts.index'))"
            class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
            type="button"
        >
            <div
                class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1024 1024"
                    height="25px"
                    width="25px"
                >
                    <path
                        d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                        fill="#000000"
                    ></path>
                    <path
                        d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                        fill="#000000"
                    ></path>
                </svg>
            </div>
            <p class="translate-x-2">Volver</p>
        </button>

        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1
                    class="text-3xl font-extrabold text-gray-900 dark:text-orange-600 sm:text-4xl"
                >
                    Información completa de la publicación
                </h1>
            </div>

            <!-- Post Card -->
            <div
                class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden transition-all duration-300"
            >
                <!-- Post Image -->
                <img
                    :src="'/images/posts/' + post.image"
                    :alt="post.title"
                    class="w-full h-64 sm:h-80 object-cover"
                />

                <!-- Post Content -->
                <div class="p-6 sm:p-8">
                    <!-- Title -->
                    <h2
                        class="text-2xl font-bold text-gray-800 dark:text-white mb-4"
                    >
                        {{ post.title }}
                    </h2>

                    <!-- Meta Info -->
                    <div
                        class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-6"
                    >
                        <span class="mr-4">
                            Publicado el: {{ formatDate(post.created_at) }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div
                        class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 mb-6"
                    >
                        <p class="whitespace-pre-line">{{ post.content }}</p>
                    </div>

                    <!-- Footer -->
                    <div
                        class="border-t border-gray-200 dark:border-gray-700 pt-6 flex justify-between items-center"
                    >
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Última actualización:
                            {{ formatDate(post.updated_at) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import PublicLayout from "../../../Layouts/PublicLayout.vue";

defineOptions({ layout: PublicLayout });

const props = defineProps(["post"]);

const formatDate = (dateString) => {
    const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    };
    return new Date(dateString).toLocaleDateString(undefined, options);
};
</script>

<style>
/* Estilos para el modo oscuro del prose */
.dark .prose-invert {
    --tw-prose-body: #d1d5db;
    --tw-prose-headings: #f3f4f6;
    --tw-prose-lead: #9ca3af;
    --tw-prose-links: #f3f4f6;
    --tw-prose-bold: #f3f4f6;
    --tw-prose-counters: #9ca3af;
    --tw-prose-bullets: #6b7280;
    --tw-prose-hr: #374151;
    --tw-prose-quotes: #f3f4f6;
    --tw-prose-quote-borders: #374151;
    --tw-prose-captions: #9ca3af;
    --tw-prose-code: #f3f4f6;
    --tw-prose-pre-code: #f3f4f6;
    --tw-prose-pre-bg: #111827;
    --tw-prose-th-borders: #4b5563;
    --tw-prose-td-borders: #4b5563;
}
</style>
