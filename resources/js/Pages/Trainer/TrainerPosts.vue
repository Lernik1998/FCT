<template>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Título y botón de crear post -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    Gestión de Posts
                </h1>
                <button
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-600 transition transform hover:scale-105"
                    @click="mostrarFormulario = true"
                >
                    + Nuevo Post
                </button>
            </div>

            <!-- Filtros y búsqueda -->
            <div class="bg-white p-4 rounded-2xl shadow-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Buscar</label>
                        <input
                            v-model="filtroBusqueda"
                            type="text"
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            placeholder="Buscar en posts..."
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2"
                            >Categoría</label
                        >
                        <select
                            v-model="filtroCategoria"
                            class="w-full p-2 border border-gray-300 rounded-lg"
                        >
                            <option value="">Todas las categorías</option>
                            <option
                                v-for="categoria in categorias"
                                :value="categoria"
                            >
                                {{ categoria }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2"
                            >Ordenar por</label
                        >
                        <select
                            v-model="orden"
                            class="w-full p-2 border border-gray-300 rounded-lg"
                        >
                            <option value="fecha-desc">
                                Más recientes primero
                            </option>
                            <option value="fecha-asc">
                                Más antiguos primero
                            </option>
                            <option value="titulo-asc">Título (A-Z)</option>
                            <option value="titulo-desc">Título (Z-A)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tabla de posts -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Título
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Categoría
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Fecha
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="post in postsPaginados"
                                :key="post.id"
                                class="hover:bg-gray-50"
                            >
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">
                                        {{ post.titulo }}
                                    </div>
                                    <div
                                        class="text-sm text-gray-500 line-clamp-1"
                                    >
                                        {{ post.contenido }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        :class="colorCategoria(post.categoria)"
                                    >
                                        {{ post.categoria }}
                                    </span>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                >
                                    {{ formatearFecha(post.fecha) }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                >
                                    <button
                                        @click="editarPost(post)"
                                        class="text-blue-600 hover:text-blue-900 mr-3"
                                    >
                                        Editar
                                    </button>
                                    <button
                                        @click="confirmarEliminar(post)"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="postsFiltrados.length === 0">
                                <td
                                    colspan="4"
                                    class="px-6 py-4 text-center text-gray-500"
                                >
                                    No se encontraron posts
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div
                    class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                >
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button
                            @click="paginaActual--"
                            :disabled="paginaActual === 1"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                        >
                            Anterior
                        </button>
                        <button
                            @click="paginaActual++"
                            :disabled="paginaActual === totalPaginas"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                        >
                            Siguiente
                        </button>
                    </div>
                    <div
                        class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                    >
                        <div>
                            <p class="text-sm text-gray-700">
                                Mostrando
                                <span class="font-medium">{{
                                    (paginaActual - 1) * porPagina + 1
                                }}</span>
                                a
                                <span class="font-medium">{{
                                    Math.min(
                                        paginaActual * porPagina,
                                        postsFiltrados.length
                                    )
                                }}</span>
                                de
                                <span class="font-medium">{{
                                    postsFiltrados.length
                                }}</span>
                                resultados
                            </p>
                        </div>
                        <div>
                            <nav
                                class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination"
                            >
                                <button
                                    @click="paginaActual = 1"
                                    :disabled="paginaActual === 1"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                >
                                    <span class="sr-only">Primera</span>
                                    «
                                </button>
                                <button
                                    @click="paginaActual--"
                                    :disabled="paginaActual === 1"
                                    class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                >
                                    <span class="sr-only">Anterior</span>
                                    ‹
                                </button>
                                <button
                                    v-for="page in paginasMostradas"
                                    @click="paginaActual = page"
                                    :class="{
                                        'bg-blue-50 border-blue-500 text-blue-600 z-10':
                                            paginaActual === page,
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50':
                                            paginaActual !== page,
                                    }"
                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                >
                                    {{ page }}
                                </button>
                                <button
                                    @click="paginaActual++"
                                    :disabled="paginaActual === totalPaginas"
                                    class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                >
                                    <span class="sr-only">Siguiente</span>
                                    ›
                                </button>
                                <button
                                    @click="paginaActual = totalPaginas"
                                    :disabled="paginaActual === totalPaginas"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                >
                                    <span class="sr-only">Última</span>
                                    »
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario flotante para nuevo/editar post -->
            <div
                v-if="mostrarFormulario"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div
                    class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-2xl"
                >
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">
                        {{
                            postEditando
                                ? "✏️ Editar Post"
                                : "✏️ Crear Nuevo Post"
                        }}
                    </h2>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2"
                                >Título *</label
                            >
                            <input
                                v-model="formPost.titulo"
                                type="text"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Ej: Consejos para correr mejor"
                                required
                            />
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2"
                                >Contenido *</label
                            >
                            <textarea
                                v-model="formPost.contenido"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 h-32"
                                placeholder="Escribe aquí tu mensaje..."
                                required
                            ></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2"
                                >Categoría *</label
                            >
                            <select
                                v-model="formPost.categoria"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                required
                            >
                                <option value="" disabled>
                                    Selecciona una categoría
                                </option>
                                <option
                                    v-for="categoria in categorias"
                                    :value="categoria"
                                >
                                    {{ categoria }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button
                            @click="cerrarFormulario"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400"
                        >
                            Cancelar
                        </button>
                        <button
                            @click="guardarPost"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600"
                        >
                            {{ postEditando ? "Actualizar" : "Publicar" }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal de confirmación para eliminar -->
            <div
                v-if="mostrarConfirmacion"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        ¿Eliminar post?
                    </h2>
                    <p class="text-gray-600 mb-6">
                        ¿Estás seguro de que quieres eliminar el post "{{
                            postAEliminar?.titulo
                        }}"? Esta acción no se puede deshacer.
                    </p>

                    <div class="flex justify-end space-x-3">
                        <button
                            @click="mostrarConfirmacion = false"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400"
                        >
                            Cancelar
                        </button>
                        <button
                            @click="eliminarPost"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                        >
                            Sí, eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from "vue";
import Chart from "chart.js/auto";
import TrainerLayout from "@/Layouts/TrainerLayout.vue";

defineOptions({
    layout: TrainerLayout,
});

// Datos de posts
const posts = ref([
    {
        id: 1,
        titulo: "Entrenamiento de resistencia",
        contenido:
            "Descubre cómo mejorar tu resistencia en 30 días con estos ejercicios progresivos y rutinas específicas.",
        categoria: "Entrenamiento",
        fecha: new Date(2023, 5, 15),
    },
]);

// Categorías disponibles
const categorias = ref([
    "Entrenamiento",
    "Nutrición",
    "Salud",
    "Psicología",
    "Equipamiento",
    "Eventos",
]);

// Filtros
const filtroBusqueda = ref("");
const filtroCategoria = ref("");
const orden = ref("fecha-desc");

// Paginación
const paginaActual = ref(1);
const porPagina = ref(5);

// Formulario
const mostrarFormulario = ref(false);
const postEditando = ref(null);
const formPost = ref({
    titulo: "",
    contenido: "",
    categoria: "",
});

// Confirmación de eliminación
const mostrarConfirmacion = ref(false);
const postAEliminar = ref(null);

// Gráfico
const graficoActividad = ref(null);
let chartInstance = null;

// Computed: Posts filtrados y ordenados
const postsFiltrados = computed(() => {
    let filtered = [...posts.value];

    // Filtrar por búsqueda
    if (filtroBusqueda.value) {
        const searchTerm = filtroBusqueda.value.toLowerCase();
        filtered = filtered.filter(
            (post) =>
                post.titulo.toLowerCase().includes(searchTerm) ||
                post.contenido.toLowerCase().includes(searchTerm)
        );
    }

    // Filtrar por categoría
    if (filtroCategoria.value) {
        filtered = filtered.filter(
            (post) => post.categoria === filtroCategoria.value
        );
    }

    // Ordenar
    switch (orden.value) {
        case "fecha-desc":
            return filtered.sort((a, b) => b.fecha - a.fecha);
        case "fecha-asc":
            return filtered.sort((a, b) => a.fecha - b.fecha);
        case "titulo-asc":
            return filtered.sort((a, b) => a.titulo.localeCompare(b.titulo));
        case "titulo-desc":
            return filtered.sort((a, b) => b.titulo.localeCompare(a.titulo));
        default:
            return filtered;
    }
});

// Computed: Posts paginados
const postsPaginados = computed(() => {
    const start = (paginaActual.value - 1) * porPagina.value;
    const end = start + porPagina.value;
    return postsFiltrados.value.slice(start, end);
});

// Computed: Total de páginas
const totalPaginas = computed(() => {
    return Math.ceil(postsFiltrados.value.length / porPagina.value);
});

// Computed: Páginas a mostrar en la paginación
const paginasMostradas = computed(() => {
    const paginas = [];
    const maxPaginas = 5; // Máximo de números de página a mostrar

    if (totalPaginas.value <= maxPaginas) {
        for (let i = 1; i <= totalPaginas.value; i++) {
            paginas.push(i);
        }
    } else {
        let start = Math.max(
            1,
            paginaActual.value - Math.floor(maxPaginas / 2)
        );
        let end = Math.min(totalPaginas.value, start + maxPaginas - 1);

        if (end - start + 1 < maxPaginas) {
            start = Math.max(1, end - maxPaginas + 1);
        }

        for (let i = start; i <= end; i++) {
            paginas.push(i);
        }
    }

    return paginas;
});

// Métodos
const formatearFecha = (fecha) => {
    return fecha.toLocaleDateString("es-ES", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    });
};

const colorCategoria = (categoria) => {
    const colores = {
        Entrenamiento: "bg-blue-100 text-blue-800",
        Nutrición: "bg-green-100 text-green-800",
        Salud: "bg-red-100 text-red-800",
        Psicología: "bg-purple-100 text-purple-800",
        Equipamiento: "bg-yellow-100 text-yellow-800",
        Eventos: "bg-indigo-100 text-indigo-800",
    };
    return colores[categoria] || "bg-gray-100 text-gray-800";
};

const abrirFormularioNuevo = () => {
    postEditando.value = null;
    formPost.value = {
        titulo: "",
        contenido: "",
        categoria: "",
    };
    mostrarFormulario.value = true;
};

const editarPost = (post) => {
    postEditando.value = post;
    formPost.value = {
        titulo: post.titulo,
        contenido: post.contenido,
        categoria: post.categoria,
    };
    mostrarFormulario.value = true;
};

const cerrarFormulario = () => {
    mostrarFormulario.value = false;
};

const guardarPost = () => {
    if (
        !formPost.value.titulo ||
        !formPost.value.contenido ||
        !formPost.value.categoria
    ) {
        alert("Por favor, completa todos los campos obligatorios");
        return;
    }

    if (postEditando.value) {
        // Editar post existente
        const index = posts.value.findIndex(
            (p) => p.id === postEditando.value.id
        );
        if (index !== -1) {
            posts.value[index] = {
                ...posts.value[index],
                titulo: formPost.value.titulo,
                contenido: formPost.value.contenido,
                categoria: formPost.value.categoria,
            };
        }
    } else {
        // Crear nuevo post
        const nuevoId = Math.max(...posts.value.map((p) => p.id), 0) + 1;
        posts.value.unshift({
            id: nuevoId,
            titulo: formPost.value.titulo,
            contenido: formPost.value.contenido,
            categoria: formPost.value.categoria,
            fecha: new Date(),
        });
    }

    cerrarFormulario();
    actualizarGrafico();

    // Resetear a la primera página después de añadir/editar
    paginaActual.value = 1;
};

const confirmarEliminar = (post) => {
    postAEliminar.value = post;
    mostrarConfirmacion.value = true;
};

const eliminarPost = () => {
    if (postAEliminar.value) {
        posts.value = posts.value.filter(
            (p) => p.id !== postAEliminar.value.id
        );
        mostrarConfirmacion.value = false;
        actualizarGrafico();

        // Ajustar la página si quedó vacía
        if (postsPaginados.value.length === 0 && paginaActual.value > 1) {
            paginaActual.value--;
        }
    }
};

const actualizarGrafico = () => {
    nextTick(() => {});
};
</script>

<style scoped>
.line-clamp-1 {
    display: -webkit-box;
    /* -webkit-line-clamp: 1; */
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
