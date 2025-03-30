<template>
    <div
        class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
    >
        <!-- Imagen del entrenador -->
        <div class="relative h-48 overflow-hidden">
            <!-- <img
                :src="trainer.image || defaultTrainerImage"
                :alt="`Foto de ${trainer.name}`"
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
            /> -->
            <span
                class="absolute top-4 right-4 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md"
            >
                Entrenador
            </span>
        </div>

        <div class="p-6">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        {{ trainer.name }}
                    </h3>
                    <p class="text-sm text-gray-500">Entrenador certificado</p>
                </div>
                <span
                    class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded"
                >
                    5+ años
                </span>
            </div>

            <div class="flex flex-wrap gap-2 mb-4">
                <span
                    v-for="(tag, index) in trainer.tags"
                    :key="index"
                    class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded"
                >
                    {{ tag }}
                </span>
            </div>

            <p class="text-gray-600 mb-4 line-clamp-3">
                {{
                    trainer.description ||
                    "Profesional del fitness con amplia experiencia ayudando a clientes a alcanzar sus objetivos."
                }}
            </p>

            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="flex text-amber-400 mr-2">
                            <span v-for="i in 5" :key="i">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    :class="{
                                        'text-gray-300':
                                            i > (trainer.rating || 4),
                                    }"
                                >
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                    />
                                </svg>
                            </span>
                        </div>
                        <!-- <span class="text-gray-500 text-sm">4.5</span> -->
                    </div>
                    <!-- <span class="text-sm text-gray-500">50€/h</span> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(["trainer"]);
</script>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
