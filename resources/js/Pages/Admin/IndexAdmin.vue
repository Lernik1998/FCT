<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-800 dark:text-gray-600">
        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <!-- Encabezado -->
            <div class="text-center mb-10">
                <h1
                    class="text-3xl font-extrabold text-gray-900 sm:text-4xl dark:text-white"
                >
                    Gestiona todos los aspectos de tu plataforma
                </h1>
                <!-- <p class="mt-3 text-lg text-gray-500">
                  
                </p> -->
            </div>

            <!-- Tarjetas de opciones -->
            <div class="grid gap-6 mb-10 md:grid-cols-2 lg:grid-cols-3">
                <!-- Tarjeta Usuarios -->
                <div
                    class="bg-white overflow-hidden shadow rounded-lg transition-all duration-200 hover:shadow-lg"
                >
                    <div class="px-6 py-5">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 bg-blue-500 rounded-md p-3"
                            >
                                <svg
                                    class="h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Gestión de Usuarios
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 truncate">
                                    Administra usuarios registrados
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a
                                :href="route('admin.userAdmin')"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800"
                            >
                                Acceder
                                <svg
                                    class="ml-1 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Entrenadores -->
                <div
                    class="bg-white overflow-hidden shadow rounded-lg transition-all duration-200 hover:shadow-lg"
                >
                    <div class="px-6 py-5">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 bg-green-500 rounded-md p-3"
                            >
                                <svg
                                    class="h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Gestión de Entrenadores
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 truncate">
                                    Revisa y gestiona entrenadores
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a
                                :href="route('admin.trainerAdmin')"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800"
                            >
                                Acceder
                                <svg
                                    class="ml-1 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Actividades -->
                <div
                    class="bg-white overflow-hidden shadow rounded-lg transition-all duration-200 hover:shadow-lg"
                >
                    <div class="px-6 py-5">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 bg-purple-500 rounded-md p-3"
                            >
                                <svg
                                    class="h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Actividades
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 truncate">
                                    Gestiona actividades de usuarios
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a
                                :href="route('admin.activityAdmin')"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800"
                            >
                                Acceder
                                <svg
                                    class="ml-1 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Configuración -->
                <div
                    class="bg-white overflow-hidden shadow rounded-lg transition-all duration-200 hover:shadow-lg"
                >
                    <div class="px-6 py-5">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 bg-yellow-500 rounded-md p-3"
                            >
                                <svg
                                    class="h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Configuración
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Ajustes generales de la plataforma
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a
                                href="#"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800"
                            >
                                Configurar
                                <svg
                                    class="ml-1 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Suscripciones -->
                <div
                    class="bg-white overflow-hidden shadow rounded-lg transition-all duration-200 hover:shadow-lg"
                >
                    <div class="px-6 py-5">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 bg-blue-500 rounded-md p-3"
                            >
                                <svg
                                    class="h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H9a2 2 0 00-2 2v2M7 15v2a2 2 0 002 2h6a2 2 0 002-2v-2M3 10h18M3 14h18"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Gestión de Suscripciones
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 truncate">
                                    Administra suscripciones registradas
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a
                                :href="route('admin.subscriptionAdmin')"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800"
                            >
                                Acceder
                                <svg
                                    class="ml-1 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de pagos -->
                <div
                    class="bg-white overflow-hidden shadow rounded-lg transition-all duration-200 hover:shadow-lg"
                >
                    <div class="px-6 py-5">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 bg-blue-500 rounded-md p-3"
                            >
                                <svg
                                    class="h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H9a2 2 0 00-2 2v2M7 15v2a2 2 0 002 2h6a2 2 0 002-2v-2M3 10h18M3 14h18"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Gestión de pagos
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 truncate">
                                    Administra pagos registrados
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a
                                :href="route('admin.membershipReservations')"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800"
                            >
                                Acceder
                                <svg
                                    class="ml-1 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Calendario -->
            <section class="mt-12">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        Calendario de Eventos
                    </h2>
                    <div id="calendar" class="h-96"></div>
                </div>
            </section>

            <!-- Sección de Gráficos -->
            <section class="mt-12">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        Asistencia Mensual
                    </h2>
                    <canvas id="attendanceChart" class="w-full h-96"></canvas>
                </div>
            </section>
        </main>
    </div>
</template>

<script setup>
import { onMounted } from "vue";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import googleCalendarPlugin from "@fullcalendar/google-calendar";
import esLocale from "@fullcalendar/core/locales/es";
import Chart from "chart.js/auto";

// Componentes
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

onMounted(() => {
    const calendarEl = document.getElementById("calendar");
    const calendar = new Calendar(calendarEl, {
        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin,
            googleCalendarPlugin,
        ],
        initialView: "dayGridMonth",
        locale: esLocale,
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        buttonText: {
            today: "Hoy",
            month: "Mes",
            week: "Semana",
            day: "Día",
        },
        events: {},
        eventClick: function (info) {
            info.jsEvent.preventDefault(); // previene la navegación

            // Puedes personalizar lo que pasa al hacer clic en un evento
            console.log("Evento clickeado:", info.event.title);
            console.log("Comienza:", info.event.start);
            console.log("Termina:", info.event.end);
        },
        loading: function (bool) {
            document.getElementById("loading").style.display = bool
                ? "block"
                : "none";
        },
        firstDay: 1, // Lunes como primer día de la semana
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5], // Lunes a Viernes
            startTime: "08:00",
            endTime: "20:00",
        },
        editable: true, // Permite arrastrar y soltar eventos
        selectable: true, // Permite seleccionar intervalos de tiempo
    });

    calendar.render();

    const ctx = document.getElementById("attendanceChart");
    new Chart(ctx, {
        type: "line",
        data: {
            labels: [
                "Ene",
                "Feb",
                "Mar",
                "Abr",
                "May",
                "Jun",
                "Jul",
                "Ago",
                "Sep",
                "Oct",
                "Nov",
                "Dic",
            ],
            datasets: [
                {
                    label: "Clases asistidas",
                    data: [
                        120, 135, 150, 165, 180, 200, 210, 205, 220, 230, 240,
                        250,
                    ],
                    fill: false,
                    borderColor: "rgba(59, 130, 246, 1)",
                    tension: 0.1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: "Total de clases",
                    },
                },
            },
            plugins: {
                title: {
                    display: true,
                    text: "Crecimiento en asistencia del año 2025",
                    font: {
                        size: 16,
                    },
                },
            },
        },
    });
});
</script>
