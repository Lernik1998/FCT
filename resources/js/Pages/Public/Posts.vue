<template>
    <section class="min-h-screen dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2
                class="text-3xl font-bold text-center dark:text-white text-orange-600 mb-12 mt-4"
            >
                Comparte tu esfuerzo, celebra tus logros.
            </h2>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
            >
                <!-- Tarjeta de post -->
                <div
                    v-for="(post, index) in visiblePosts"
                    :key="`post-${index}-${post.id}`"
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300"
                    @click="router.visit(route('posts.show', post.id))"
                >
                    <div class="relative h-64 overflow-hidden">
                        <img
                            v-if="post.image"
                            :src="'/images/posts/' + post.image"
                            :alt="post.title"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        />
                        <div
                            v-else
                            class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center"
                        >
                            <span class="text-gray-500 dark:text-gray-300"
                                >Sin imagen</span
                            >
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"
                        ></div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-bold line-clamp-2 text-orange-500 dark:text-orange-400"
                        >
                            {{ post.title }}
                        </h3>
                        <p
                            class="text-gray-900 dark:text-gray-200 font-medium mb-2 line-clamp-2"
                        >
                            {{ post.content }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Cargando más datos -->
            <div v-if="loading" class="w-full text-center py-8">
                <div
                    class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-orange-500"
                ></div>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Cargando más posts...
                </p>
            </div>

            <!-- Observador para scroll infinito -->
            <div ref="observerElement" class="h-1"></div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    posts: {
        type: Array,
        required: true,
        validator: (value) => Array.isArray(value),
    },
});

// Configuración del scroll infinito
const batchSize = 8;
const loadedItems = ref(batchSize);
const loading = ref(false);
const observerElement = ref(null);

// Posts visibles
const visiblePosts = computed(() => {
    return props.posts.slice(0, loadedItems.value);
});

// Cargar más posts
const loadMorePosts = () => {
    if (loading.value || loadedItems.value >= props.posts.length) return;

    loading.value = true;

    setTimeout(() => {
        loadedItems.value += batchSize;
        loading.value = false;
    }, 800);
};

// Observador de intersección para carga infinita
let observer;
onMounted(() => {
    observer = new IntersectionObserver(
        (entries) => {
            if (entries[0].isIntersecting) {
                loadMorePosts();
            }
        },
        {
            rootMargin: "100px",
            threshold: 0.1,
        }
    );

    if (observerElement.value) {
        observer.observe(observerElement.value);
    }

    // Carga inicial si no hay suficientes posts
    if (
        visiblePosts.value.length < batchSize * 2 &&
        loadedItems.value < props.posts.length
    ) {
        loadMorePosts();
    }
});

onUnmounted(() => {
    if (observer) {
        observer.disconnect();
    }
});
</script>

<style scoped>
/* Limitar texto a 2 líneas */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Hacer que la navegación sea sticky */
.sticky {
    position: sticky;
}
</style>
