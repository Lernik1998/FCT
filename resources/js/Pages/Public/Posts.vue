<template>
    <section class="py-16  min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">
                Comparte tu esfuerzo, celebra tus logros.
            </h2>

            <!-- Contenedor sin scroll interno -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
            >
                <!-- Tarjeta de post -->
                <div
                    v-for="(post, index) in visiblePosts"
                    :key="`post-${index}-${post.id}`"
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300"
                >
                    <div class="relative h-64 overflow-hidden">
                        <img
                            v-if="post.image"
                            src="../../../../public/ownImages/comunidad.jpg"
                            :alt="post.title"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        />
                        <div
                            v-else
                            class="w-full h-full bg-gray-200 flex items-center justify-center"
                        >
                            <span class="text-gray-500">Sin imagen</span>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                        ></div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-bold text-gray-900 line-clamp-2"
                        >
                            {{ post.title }}
                        </h3>
                        <p
                            class="text-orange-500 font-medium mb-2 line-clamp-2"
                        >
                            {{ post.content }}
                        </p>
                        <div
                            v-if="post.user_id"
                            class="mt-4 flex flex-wrap gap-2"
                        >
                            <span
                                class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded"
                            >
                                User ID: {{ post.user_id }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cargando más datos -->
            <div v-if="loading" class="w-full text-center py-8">
                <div
                    class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-orange-500"
                ></div>
                <p class="mt-2 text-gray-600">Cargando más posts...</p>
            </div>

            <!-- Elemento observador para carga infinita -->
            <div ref="observerElement" class="h-1"></div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import NavBar from "./Components/NavBar.vue";

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
    /* -webkit-line-clamp: 2; */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Hacer que la navegación sea sticky */
.sticky {
    position: sticky;
}
</style>
