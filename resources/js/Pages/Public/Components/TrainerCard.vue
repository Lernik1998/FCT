<template>
    <div
        class="bg-gray-100 dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
    >
        <!-- Imagen del entrenador -->
        <div class="relative h-48 overflow-hidden">
            <img
                :src="'/images/trainers/' + trainer.profile_photo_path"
                :alt="`Foto de ${trainer.name}`"
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
            />

            <!--    <img
                        :src="'/images/posts/' + postSeleccionado.image"
                        :alt="postSeleccionado.title"
                        class="w-full h-auto rounded-lg"
                    /> -->
        </div>

        <div class="p-6">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h3
                        class="text-xl font-bold text-gray-800 dark:text-orange-500"
                    >
                        {{ trainer.name }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Entrenador certificado
                    </p>
                </div>
                <span
                    class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs px-2 py-1 rounded"
                >
                    {{ trainer.experience_time }} años de experiencia
                </span>
            </div>

            <div class="flex flex-wrap gap-2 mb-4">
                <span
                    v-for="(tag, index) in trainer.tags"
                    :key="index"
                    class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs px-2 py-1 rounded"
                >
                    {{ tag }}
                </span>
            </div>

            <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
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
