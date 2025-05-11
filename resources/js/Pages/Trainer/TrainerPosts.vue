<template>
    <div
        class=" mx-auto px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-900 min-h-screen transition-colors duration-300"
    >
        <!-- Header y botón de creación -->
        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4"
        >
            <h1
                class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-orange-500"
            >
                Gestión de Posts
            </h1>

            <button
                @click="abrirFormularioNuevo"
                class="w-full sm:w-auto bg-orange-600 hover:bg-orange-700 dark:bg-orange-700 dark:hover:bg-orange-800 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
            >
                Crear nuevo post
            </button>
        </div>

        <!-- Filtros y búsqueda -->
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6"
        >
            <!-- Filtros de categoría -->
            <div class="flex flex-wrap gap-2">
                <button
                    v-for="categoria in categorias"
                    :key="categoria"
                    @click="filtrarPorCategoria(categoria)"
                    class="bg-blue-100 hover:bg-blue-200 dark:bg-blue-900 dark:hover:bg-blue-800 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm"
                >
                    {{ categoria }}
                </button>
            </div>

            <!-- Buscador -->
            <div class="w-full md:w-64 relative">
                <input
                    type="text"
                    v-model="search"
                    placeholder="Buscar posts..."
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100 dark:placeholder-gray-400"
                />
                <svg
                    class="absolute left-3 top-2.5 h-5 w-5 text-gray-400 dark:text-gray-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                </svg>
            </div>
        </div>

        <!-- Tabla de posts -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-300"
        >
            <div class="overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Título
                            </th>
                            <th
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell"
                            >
                                Contenido
                            </th>
                            <th
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Fecha
                            </th>
                            <th
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <tr
                            v-for="post in posts.data"
                            :key="post.id"
                            class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150"
                        >
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div
                                    class="font-medium text-gray-900 dark:text-gray-100"
                                >
                                    {{ post.title }}
                                </div>
                            </td>
                            <td class="px-4 py-4 hidden sm:table-cell">
                                <div
                                    class="text-gray-600 dark:text-gray-300 text-sm line-clamp-1"
                                >
                                    {{ post.content.substring(0, 50) }}...
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div
                                    class="text-gray-600 dark:text-gray-300 text-sm"
                                >
                                    {{ formatDate(post.created_at) }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <button
                                        @click="editarPost(post)"
                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200"
                                    >
                                        Editar
                                    </button>
                                    <button
                                        @click="confirmarEliminar(post)"
                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200"
                                    >
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div
                class="px-4 sm:px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-4"
            >
                <div class="text-sm text-gray-600 dark:text-gray-300">
                    Mostrando página {{ posts.current_page }} de
                    {{ posts.last_page }}
                </div>
                <div class="flex flex-wrap gap-1">
                    <Component
                        :is="link.url ? 'Link' : 'span'"
                        v-for="(link, index) in posts.links"
                        :key="index"
                        :href="link.url"
                        class="px-3 py-1 rounded-md text-sm"
                        :class="{
                            'bg-blue-600 text-white dark:bg-blue-700':
                                link.active,
                            'bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700':
                                !link.active && link.url,
                            'text-gray-400 dark:text-gray-500 cursor-not-allowed':
                                !link.url,
                        }"
                        v-html="link.label"
                    />
                </div>
            </div>
        </div>

        <!-- Gráfico -->
        <div class="mt-8 flex justify-center">
            <div class="w-full max-w-xs">
                <canvas ref="graficoActividad" class="w-full h-auto"></canvas>
            </div>
        </div>

        <!-- Modal de formulario -->
        <div
            v-if="mostrarFormulario"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300"
        >
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl w-full max-w-2xl mx-4 transition-all duration-300 border border-gray-200 dark:border-gray-700"
            >
                <h2
                    class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4"
                >
                    {{ formPost.id ? "✏️ Editar post" : "✏️ Crear nuevo post" }}
                </h2>

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label
                            class="block text-gray-700 dark:text-gray-300 mb-2"
                            >Título</label
                        >
                        <input
                            v-model="formPost.titulo"
                            type="text"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                            placeholder="Ej: Consejos para correr mejor"
                            required
                        />
                    </div>

                    <div>
                        <label
                            class="block text-gray-700 dark:text-gray-300 mb-2"
                            >Contenido</label
                        >
                        <textarea
                            v-model="formPost.contenido"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 h-32 dark:bg-gray-700 dark:text-gray-100"
                            placeholder="Escribe aquí tu mensaje..."
                            required
                        ></textarea>
                    </div>

                    <div>
                        <label
                            class="block text-gray-700 dark:text-gray-300 mb-2"
                            >Imagen</label
                        >
                        <input
                            type="file"
                            multiple
                            accept="image/*"
                            ref="fileInput"
                            @change="handleFileChange"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700"
                        />
                    </div>
                </div>

                <div class="flex justify-end mt-6 gap-3">
                    <button
                        @click="cerrarFormulario"
                        class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-100 font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                    >
                        Cancelar
                    </button>
                    <button
                        @click="guardarPost"
                        class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                    >
                        {{ formPost.id ? "Actualizar" : "Crear" }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal de confirmación de eliminación -->
        <div
            v-if="mostrarConfirmacion"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300"
        >
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl w-full max-w-md mx-4 transition-all duration-300 border border-gray-200 dark:border-gray-700"
            >
                <h2
                    class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4"
                >
                    Confirmar eliminación
                </h2>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    ¿Estás seguro de que deseas eliminar este post? Esta acción
                    no se puede deshacer.
                </p>
                <div class="flex justify-end gap-3">
                    <button
                        @click="mostrarConfirmacion = false"
                        class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-100 font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                    >
                        Cancelar
                    </button>
                    <button
                        @click="eliminarPost"
                        class="bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
                    >
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick, watch } from "vue";
import Chart from "chart.js/auto";
import TrainerLayout from "@/Layouts/TrainerLayout.vue";
import { debounce } from "lodash";
import { router } from "@inertiajs/vue3";

defineOptions({
    layout: TrainerLayout,
});

const props = defineProps({
    posts: Array,
    filters: Object,
    totalPosts: Number,
});

const search = ref(props.filters.search || "");

watch(
    search,
    debounce((value) => {
        router.get(
            route("trainers.posts"),
            { search: value },
            {
                preserveState: true,
                replace: true,
                preserveScroll: true,
            }
        );
    }, 300)
);

// Formulario
const mostrarFormulario = ref(false);
const formPost = ref({
    titulo: "",
    contenido: "",
    image: "",
});

// Confirmación de eliminación
const mostrarConfirmacion = ref(false);
const postAEliminar = ref(null);

const handleFileChange = (event) => {
    const files = event.target.files;
    formPost.value.image = Array.from(files).map((file) => file.name);
};

// Gráfico
const graficoActividad = ref(null);
let chartInstance = null;

const actualizarGrafico = () => {
    if (chartInstance) {
        chartInstance.destroy();
    }

    chartInstance = new Chart(graficoActividad.value, {
        type: "doughnut",
        data: {
            labels: ["Total de Posts"],
            datasets: [
                {
                    label: "Número de Posts",
                    data: [props.totalPosts],
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            cutoutPercentage: 50, // Para que sea más parecido a un gráfico de dona
            plugins: {
                legend: {
                    display: false, // Ocultamos la leyenda si no es necesaria
                },
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            return `${context.label}: ${context.raw} posts`;
                        },
                    },
                },
            },
        },
    });
};

const formatDate = (dateString) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

const abrirFormularioNuevo = () => {
    mostrarFormulario.value = true;
    formPost.value = {
        titulo: "",
        contenido: "",
        imagen: "",
    };
};

const editarPost = (post) => {
    postEditando.value = post;
    formPost.value = {
        titulo: post.titulo,
        contenido: post.contenido,
        imagen: post.imagen,
    };
    mostrarFormulario.value = true;
};

const cerrarFormulario = () => {
    mostrarFormulario.value = false;
};

const guardarPost = () => {
    if (!formPost.value.titulo || !formPost.value.contenido) {
        alert("Por favor, completa todos los campos obligatorios");
        return;
    }

    // Crear nuevo post
    router.post(route("trainers.storePost"), {
        titulo: formPost.value.titulo,
        contenido: formPost.value.contenido,
        imagen: formPost.value.imagen,
    });

    cerrarFormulario();
    actualizarGrafico();
};

const confirmarEliminar = (post) => {
    // postAEliminar.value = post;
    // mostrarConfirmacion.value = true;
};

const eliminarPost = () => {
    // if (postAEliminar.value) {
    //     posts.value = posts.value.filter(
    //         (p) => p.id !== postAEliminar.value.id
    //     );
    //     mostrarConfirmacion.value = false;
    //     actualizarGrafico();
    //     // Ajustar la página si quedó vacía
    //     if (postsPaginados.value.length === 0 && paginaActual.value > 1) {
    //         paginaActual.value--;
    //     }
    // }
};

// TODO:
// const colorCategoria = (categoria) => {
//     const colores = {
//         Entrenamiento: "bg-blue-100 text-blue-800",
//         Nutrición: "bg-green-100 text-green-800",
//         Salud: "bg-red-100 text-red-800",
//         Psicología: "bg-purple-100 text-purple-800",
//         Equipamiento: "bg-yellow-100 text-yellow-800",
//         Eventos: "bg-indigo-100 text-indigo-800",
//     };
//     return colores[categoria] || "bg-gray-100 text-gray-800";
// };

// const actualizarGrafico = () => {
//     nextTick(() => {});
// };

onMounted(() => {
    nextTick(() => {
        actualizarGrafico();
    });
});

watch(
    () => props.posts,
    () => {
        nextTick(() => {
            actualizarGrafico();
        });
    }
);
</script>

<style scoped>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

</style>
