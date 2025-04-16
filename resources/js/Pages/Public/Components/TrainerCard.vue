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
