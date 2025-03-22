<script setup>
import Modal from "./Modal.vue";

const emit = defineEmits(["close"]);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: "2xl",
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    title: {
        type: String,
        default: "Confirmación",
    },
    content: {
        type: String,
        default:
            "¿Estás seguro de que quieres marcar este mensaje como resuelto?",
    },
    footer: {
        type: String,
        default:
            "¿Estás seguro de que quieres marcar este mensaje como resuelto?",
    },
});

const close = () => {
    emit("close");
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden"
        >
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg
                            class="w-6 h-6 text-green-600 dark:text-green-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3
                            class="text-lg font-medium text-gray-900 dark:text-gray-100"
                        >
                            {{ title }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ content }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex">
                {{ footer }}
            </div>
        </div>
    </Modal>
</template>
