<template>
    <div>
        <!-- Barra de Navegación -->
        <nav
            class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg sticky top-0 z-50"
        >
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <!-- <img src="/logo-fitworking.png" alt="FitWorking Logo" class="h-10"> -->
                    <h1 class="text-xl font-bold">¡Hola, {{ user.name }}!</h1>
                </div>
                <UsersNavBar />
            </div>
        </nav>

        <section class="bg-gradient-to-b from-orange-100 to-white py-12 px-4">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">
                    Transforma tu pasión en resultados
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8">
                    Descubre eventos deportivos cerca de ti y conecta con una
                    comunidad activa
                </p>
                <div class="flex justify-center space-x-4">
                    <!-- <button
                        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-full transition-all shadow-lg"
                    >
                        Ver eventos destacados
                    </button> -->
                    <button
                        class="border-2 border-orange-500 text-orange-500 hover:bg-orange-50 font-bold py-3 px-6 rounded-full transition-all"
                        onclick="window.open('https://t.me/+oRCyDr_AbqQwMDM0', '_blank')"
                    >
                        Acceso a comunidad
                    </button>
                </div>
            </div>
        </section>

        <!-- Contenido Principal -->
        <main class="container mx-auto py-8 px-4">
            <!-- Sección de Eventos Destacados -->
            <section class="mb-16">
                <h3 class="text-2xl font-bold mb-6 flex items-center">
                    <!-- <span
                        class="bg-orange-500 text-white p-2 rounded-full mr-3"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                            />
                        </svg>
                    </span> -->
                    Eventos destacados en tu zona
                </h3>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                >
                    <div
                        v-for="activity in featuredActivities"
                        :key="activity.id"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1"
                    >
                        <div class="relative h-48 overflow-hidden">
                            <img
                                :src="activity.image || '/default-sport.jpg'"
                                :alt="activity.name"
                                class="w-full h-full object-cover"
                            />
                            <div
                                class="absolute top-2 right-2 bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold"
                            >
                                {{ activity.category }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-xl font-bold text-gray-800">
                                    {{ activity.name }}
                                </h4>
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full"
                                >
                                    {{ activity.duration }} min
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4 line-clamp-2">
                                {{ activity.description }}
                            </p>
                            <div class="flex justify-between items-center">
                                <div
                                    class="flex items-center text-sm text-gray-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 mr-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                    {{ activity.location }}
                                </div>
                                <div class="text-sm font-bold text-orange-500">
                                    {{ formatDate(activity.date) }}
                                </div>
                            </div>
                            <div class="mt-4 flex space-x-2">
                                <a
                                    :href="
                                        route(
                                            'activities.showUserActivity',
                                            activity.id
                                        )
                                    "
                                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 text-center py-2 px-4 rounded-lg transition-colors"
                                >
                                    Detalles
                                </a>
                                <a
                                    :href="
                                        route(
                                            'userActivitiesReservations.create',
                                            activity.id
                                        )
                                    "
                                    class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-center py-2 px-4 rounded-lg transition-colors"
                                >
                                    Reservar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Todas las Actividades con Filtros -->
            <section>
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6"
                >
                    <h3
                        class="text-2xl font-bold mb-4 md:mb-0 flex items-center"
                    >
                        <span
                            class="bg-orange-500 text-white p-2 rounded-full mr-3"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                />
                            </svg>
                        </span>
                        Todas las actividades disponibles
                    </h3>

                    <!-- Pendiente -->
                    <div class="flex flex-wrap gap-2">
                        <select
                            class="bg-white border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                            <option>Todas las categorías</option>
                            <option>Fútbol</option>
                            <option>Baloncesto</option>
                            <option>Running</option>
                            <option>Yoga</option>
                        </select>
                        <select
                            class="bg-white border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                            <option>Cualquier fecha</option>
                            <option>Hoy</option>
                            <option>Esta semana</option>
                            <option>Este mes</option>
                        </select>
                        <button
                            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 inline mr-1"
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
                            Buscar
                        </button>
                    </div>
                </div>

                <!-- Lista de Actividades - Versión Mobile -->
                <div class="md:hidden space-y-4">
                    <div
                        v-for="activity in activities"
                        :key="activity.id"
                        class="bg-white rounded-lg shadow p-4"
                    >
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-bold text-lg text-gray-800">
                                {{ activity.name }}
                            </h4>
                            <span
                                class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full"
                            >
                                {{ activity.duration }} min
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            {{ activity.description }}
                        </p>
                        <div
                            class="flex justify-between text-sm text-gray-500 mb-3"
                        >
                            <span>{{ formatDate(activity.date) }}</span>
                            <!-- <span>{{ activity.location }}</span> -->
                            <!--Pendiente gestionar LOCALIZACIÓN-->
                        </div>
                        <div class="flex space-x-2">
                            <a
                                :href="
                                    route(
                                        'activities.showUserActivity',
                                        activity.id
                                    )
                                "
                                class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-3 rounded-lg text-sm transition-colors"
                            >
                                Detalles
                            </a>
                            <a
                                :href="
                                    route(
                                        'userActivitiesReservations.create',
                                        activity.id
                                    )
                                "
                                class="flex-1 text-center bg-orange-500 hover:bg-orange-600 text-white py-2 px-3 rounded-lg text-sm transition-colors"
                            >
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Lista de Actividades - Versión Desktop -->
                <div
                    class="hidden md:block bg-white rounded-xl shadow overflow-hidden"
                >
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Actividad
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Descripción
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Fecha
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Duración
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="activity in activities"
                                :key="activity.id"
                                class="hover:bg-gray-50 transition-colors"
                            >
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">
                                        {{ activity.name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ activity.category }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p
                                        class="text-gray-600 max-w-xs line-clamp-2"
                                    >
                                        {{ activity.description }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-sm text-gray-900 font-medium"
                                    >
                                        {{ formatDate(activity.date) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ activity.time }}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                >
                                    {{ activity.duration }} min
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <a
                                        :href="
                                            route(
                                                'activities.showUserActivity',
                                                activity.id
                                            )
                                        "
                                        class="text-orange-500 hover:text-orange-700 mr-4"
                                        >Detalles</a
                                    >
                                    <a
                                        :href="
                                            route(
                                                'userActivitiesReservations.create',
                                                activity.id
                                            )
                                        "
                                        class="bg-orange-500 hover:bg-orange-600 text-white py-1 px-3 rounded-lg text-sm transition-colors inline-block"
                                        >Reservar</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <!-- <div class="mt-8 flex justify-center">
                    <nav class="inline-flex rounded-md shadow">
                        <a
                            href="#"
                            class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        >
                            Anterior
                        </a>
                        <a
                            href="#"
                            class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-orange-600 hover:bg-gray-50"
                        >
                            1
                        </a>
                        <a
                            href="#"
                            class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        >
                            2
                        </a>
                        <a
                            href="#"
                            class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        >
                            3
                        </a>
                        <a
                            href="#"
                            class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                        >
                            Siguiente
                        </a>
                    </nav>
                </div> -->
            </section>
        </main>

        <!-- Contenido Principal -->
        <section class="container mx-auto py-12 px-4">
            <!-- <h2 class="text-3xl font-semibold text-center mb-6">
                Descubre los eventos que se realizarán en tu zona
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Próximos Eventos</h3>
                    <p class="text-gray-700">
                        Mantente al tanto de las proximas actividades
                        deportivas.
                    </p>
                </div>
            </div> -->

            <!-- Mensaje de éxito
            <div class="mt-10" v-if="success">
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3"
                    role="alert"
                >
                    {{ success }}
                </div>
            </div> -->

            <!-- <div class="mt-10 border-gray-200 border">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border-r">Nombre</th>
                            <th class="p-2 border-r">Descripción</th>
                            <th class="p-2 border-r">Fecha</th>
                            <th class="p-2 border-r">Duración</th>
                            <th class="p-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="activity in activities" :key="activity.id">
                            <td class="p-2 border-r">{{ activity.name }}</td>
                            <td class="p-2 border-r">
                                {{
                                    activity.description.length > 50
                                        ? activity.description.substring(
                                              0,
                                              50
                                          ) + "..."
                                        : activity.description
                                }}
                            </td>
                            <td class="p-2 border-r">{{ activity.date }}</td>
                            <td class="p-2 border-r">
                                {{ activity.duration }} min
                            </td>
                            <td class="p-2 space-x-2">
                                <a
                                    :href="
                                        route(
                                            'activities.showUserActivity',
                                            activity.id
                                        )
                                    "
                                    >Información</a
                                >
                                <a
                                    :href="
                                        route(
                                            'userActivitiesReservations.create',
                                            activity.id
                                        )
                                    "
                                    >Reservar</a
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> -->
        </section>

        <!-- Pie de Página -->
        <Footer />
    </div>
</template>

<script setup>
// Importaciones
import { computed } from "vue";
// Importaciones de componentes
import UsersNavBar from "./Components/UsersNavBar.vue";
import Footer from "./Components/UserFooter.vue";

const props = defineProps(["user", "activities"]);

// Formatear fecha
const formatDate = (dateString) => {
    const options = { weekday: "short", day: "numeric", month: "short" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

// Actividades destacadas (primeras 3)
const featuredActivities = computed(() => {
    return props.activities.slice(0, 3);
});
</script>

<style scoped>
/* .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.transition-colors {
    transition: background-color 0.2s ease, color 0.2s ease;
} */
</style>
