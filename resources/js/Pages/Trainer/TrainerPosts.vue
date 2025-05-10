<template>
    <!-- <pre>{{ posts }}</pre> -->

    <div class="flex justify-between items-center mb-6 mt-6 ml-2">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Posts</h1>

        <!-- Boton para crear nuevo post -->
        <button
            @click="abrirFormularioNuevo"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-10"
        >
            Crear nuevo post
        </button>
    </div>

    <div class="flex justify-between">
        <!-- Botones filtrados categoría -->
        <div class="col-6">
            <!-- <button
                v-for="categoria in categorias"
                :key="categoria"
                @click="filtrarPorCategoria(categoria)"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2"
            >
                {{ categoria }}
            </button> -->
        </div>

        <!-- Buscador -->
        <div class="col-6 mr-10 mb-6">
            <input
                type="text"
                v-model="search"
                placeholder="Buscar posts..."
                class="w-full p-2 border border-gray-300 rounded"
            />
        </div>
    </div>

    <!-- Tabla con los posts, con la paginación y filtro de búsqueda -->
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="px-6 py-3">Título</th>
                <th class="px-6 py-3">Contenido</th>
                <th class="px-6 py-3">Fecha</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="post in posts.data"
                :key="post.id"
                class="hover:bg-gray-100 dark:hover:bg-gray-700"
            >
                <td class="px-6 py-4">{{ post.title }}</td>
                <td class="px-6 py-4">
                    {{ post.content.substring(0, 50) }}...
                </td>
                <td class="px-6 py-4">
                    {{ formatDate(post.created_at) }}
                </td>
                <td class="px-6 py-4 space-x-2">
                    <button
                        @click="editarPost(post)"
                        class="text-blue-500 hover:text-blue-700"
                    >
                        Editar
                    </button>
                    <button
                        @click="confirmarEliminar(post)"
                        class="text-red-500 hover:text-red-700"
                    >
                        Eliminar
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Paginación -->
    <!-- <div class="pagination mt-6">
        <button
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300"
            @click="cambiarPagina(posts.current_page - 1)"
            :disabled="!posts.prev_page_url"
        >
            &laquo; Anterior
        </button>

        <span>Página {{ posts.current_page }} de {{ posts.last_page }}</span>

        <button
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300"
            @click="cambiarPagina(posts.current_page + 1)"
            :disabled="!posts.next_page_url"
        >
            Siguiente &raquo;
        </button>
    </div> -->

    <!-- Paginación -->
    <div class="mt-6 flex items-center justify-between ml-2">
        <div class="text-sm text-gray-500">
            Mostrando página {{ posts.current_page }} de
            {{ posts.last_page }}
        </div>

        <div class="flex space-x-1 mr-10">
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="(link, index) in posts.links"
                :key="index"
                :href="link.url"
                class="px-3 py-1 rounded-md border"
                :class="{
                    'border-gray-300 text-gray-500 hover:bg-gray-50':
                        link.url && !link.active,
                    'border-blue-500 bg-blue-50 text-blue-600': link.active,
                    'border-gray-200 text-gray-400 cursor-not-allowed':
                        !link.url,
                }"
                v-html="link.label"
            />
        </div>
    </div>

    <!-- Gráfico -->
    <div class="mt-10">
        <canvas ref="graficoActividad" class="grafico-pequeño"></canvas>
    </div>

    <!-- Formulario flotante para nuevo/editar post -->
    <div
        v-if="mostrarFormulario"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-2xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                {{ "✏️ Crear nuevo post" }}
            </h2>

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-gray-700 mb-2">Título</label>
                    <input
                        v-model="formPost.titulo"
                        type="text"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Ej: Consejos para correr mejor"
                        required
                    />
                </div>

                <div>
                    <label class="block text-gray-700 mb-2">Contenido</label>
                    <textarea
                        v-model="formPost.contenido"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 h-32"
                        placeholder="Escribe aquí tu mensaje..."
                        required
                    ></textarea>
                </div>

                <!-- Imagenes -->
                <div>
                    <label class="block text-gray-700 mb-2">Imagen</label>
                    <input
                        type="file"
                        multiple
                        accept="image/*"
                        ref="fileInput"
                        @change="handleFileChange"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    />
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button
                    @click="cerrarFormulario"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-200"
                >
                    Cancelar
                </button>
                <button
                    @click="guardarPost"
                    class="ml-4 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                >
                    Crear
                </button>
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
    /* -webkit-line-clamp: 1; */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.grafico-pequeño {
    width: 200px; /* Puedes ajustar este valor */
    height: 200px; /* Puedes ajustar este valor */
}
</style>
