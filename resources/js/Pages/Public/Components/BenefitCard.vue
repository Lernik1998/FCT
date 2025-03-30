<template>
    <div
        class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 h-full flex flex-col"
    >
        <!-- Icono SVG -->
        <div
            class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-8 h-8 text-orange-500"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    :d="icon"
                />
            </svg>
        </div>

        <!-- Título -->
        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ title }}</h3>

        <!-- Descripción -->
        <p class="text-gray-600 flex-grow">{{ description }}</p>

        <!-- Flecha decorativa (opcional) -->
        <!-- <div class="mt-4 text-orange-500">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                />
            </svg>
        </div> -->
    </div>
</template>

<script setup>
defineProps({
    icon: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
});
</script>

<style scoped>
/* Efecto hover sutil */
div:hover {
    transform: translateY(-5px);
}
</style>
