<template>
    <div>
        <!-- Barra de navegación -->
        <nav class="p-4 border-b shadow-md bg-white">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">Panel de Administración</div>
                <AdminNavBar />
            </div>
        </nav>

        <!-- Contenido principal -->
        <section class="p-8">
            <h1 class="text-3xl font-semibold mb-6 text-center">
                Bienvenido al Panel de Administración
            </h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105"
                >
                    <h3 class="text-xl font-semibold mb-2">
                        Gestión de Usuarios
                    </h3>
                    <p class="text-gray-700">
                        Administra usuarios registrados en la plataforma.
                    </p>
                    <a
                        :href="route('admin.userAdmin')"
                        class="text-blue-600 hover:underline"
                        >Acceder</a
                    >
                </div>
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105"
                >
                    <h3 class="text-xl font-semibold mb-2">
                        Gestión de Entrenadores
                    </h3>
                    <p class="text-gray-700">
                        Revisa y gestiona la información de los entrenadores.
                    </p>
                    <a
                        :href="route('admin.trainerAdmin')"
                        class="text-blue-600 hover:underline"
                        >Acceder</a
                    >
                </div>

                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105"
                >
                    <h3 class="text-xl font-semibold mb-2">Actividades</h3>
                    <p class="text-gray-700">
                        Gestiona y administra las actividades de los usuarios.
                    </p>
                    <a
                        :href="route('admin.activityAdmin')"
                        class="text-blue-600 hover:underline"
                        >Acceder</a
                    >
                </div>

                <!-- <div
                    class="bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105"
                >
                    <h3 class="text-xl font-semibold mb-2">Reportes</h3>
                    <p class="text-gray-700">
                        Consulta reportes de actividad y desempeño.
                    </p>
                    <a href="#" class="text-blue-600 hover:underline"
                        >Ver más</a
                    >
                </div>
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105"
                >
                    <h3 class="text-xl font-semibold mb-2">Configuración</h3>
                    <p class="text-gray-700">
                        Modifica ajustes generales de la plataforma.
                    </p>
                    <a href="#" class="text-blue-600 hover:underline"
                        >Ver más</a
                    >
                </div> -->
            </div>
        </section>

        <!-- Pie de página -->

        <section class="mt-10 ml-10">
            <div id="calendar" class="h-3/6 w-3/6"></div>
        </section>

        <!-- Cargar grafico con estadisticas de usuarios, reservas y actividades -->

        <section class="mt-10 ml-10">
            <canvas id="statsChart"></canvas>
        </section>
    </div>
</template>

<script setup>
// Importaciones
import { onMounted } from "vue";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import { router } from "@inertiajs/vue3";

// Componentes
import AdminNavBar from "@/Pages/Admin/Components/AdminNavBar.vue";

onMounted(() => {
    const calendarEl = document.getElementById("calendar");
    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin],
        initialView: "dayGridMonth",
        // otras opciones.......
    });
    calendar.render();
});
</script>
