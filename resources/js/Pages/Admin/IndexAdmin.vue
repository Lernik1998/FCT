<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-800 dark:text-gray-600">
        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <!-- Encabezado -->
            <div class="text-center mb-10">
                <h1
                    class="text-3xl font-extrabold text-gray-900 sm:text-4xl dark:text-orange-600"
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
                                <h3
                                    class="text-lg font-medium text-gray-900 dark:text-orange-600"
                                >
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
                                <h3
                                    class="text-lg font-medium text-gray-900 dark:text-orange-600"
                                >
                                    Gestión de Entrenadores
                                </h3>
                                <p
                                    class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate"
                                >
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
                                <h3
                                    class="text-lg font-medium text-gray-900 dark:text-orange-600"
                                >
                                    Actividades
                                </h3>
                                <p
                                    class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate"
                                >
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
                                        d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3
                                    class="text-lg font-medium text-gray-900 dark:text-orange-600"
                                >
                                    Administración
                                </h3>
                                <p
                                    class="mt-1 text-sm text-gray-500 dark:text-gray-400"
                                >
                                    Gestión de gastos e ingresos
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a
                                :href="route('admin.transactions')"
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

                <!-- Tarjeta de Suscripciones -->
                <div
                    class="bg-white overflow-hidden shadow rounded-lg transition-all duration-200 hover:shadow-lg"
                >
                    <div class="px-6 py-5">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 bg-cyan-500 rounded-md p-3"
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
                                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3
                                    class="text-lg font-medium text-gray-900 dark:text-orange-600"
                                >
                                    Gestión de Suscripciones
                                </h3>
                                <p
                                    class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate"
                                >
                                    Administra suscripciones registradas
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a
                                :href="route('admin.subscriptionAdmin')"
                                class="inline-flex items-center text-brown-600 hover:text-blue-800"
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
                                class="flex-shrink-0 bg-red-500 rounded-md p-3"
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
                                        d="M14.25 7.756a4.5 4.5 0 1 0 0 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3
                                    class="text-lg font-medium text-gray-900 dark:text-orange-600"
                                >
                                    Gestión de pagos
                                </h3>
                                <p
                                    class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate"
                                >
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
                    <h2
                        class="text-xl font-semibold text-gray-800 mb-4 dark:text-orange-700"
                    >
                        Calendario de Eventos
                    </h2>
                    <!-- <div id="calendar" class="h-96"></div> -->

                    <div class="p-6 bg-gray-50 dark:bg-gray-700/30">
                        <FullCalendar
                            ref="calendar"
                            class="trainer-calendar"
                            :options="calendarOptions"
                        />
                    </div>
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

        <!-- Modal de evento -->
        <div
            v-if="showEventModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md"
            >
                <div
                    class="p-5 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center"
                >
                    <h3
                        class="text-lg font-semibold text-gray-800 dark:text-white"
                    >
                        Detalles de la actividad
                    </h3>
                    <button
                        @click="closeEventModal"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
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
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <div class="p-5 space-y-4">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >Título</label
                        >
                        <p class="text-gray-900 dark:text-gray-100">
                            {{ eventoAct.title }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >Inicio</label
                            >
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ formatDate(eventoAct.start) }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >Fin</label
                            >
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ formatDate(eventoAct.end) }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >Descripción</label
                        >
                        <p class="text-gray-900 dark:text-gray-100">
                            {{
                                eventoAct.extendedProps.description ||
                                "Sin descripción"
                            }}
                        </p>
                    </div>

                    <div class="flex items-center">
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            {{
                                eventoAct.allDay
                                    ? "Evento de día completo"
                                    : "Evento por horas"
                            }}
                        </span>
                    </div>
                </div>

                <div
                    class="p-5 border-t border-gray-200 dark:border-gray-700 flex justify-end"
                >
                    <button
                        @click="closeEventModal"
                        class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                    >
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
// import { Calendar } from "@fullcalendar/core";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import googleCalendarPlugin from "@fullcalendar/google-calendar";
import esLocale from "@fullcalendar/core/locales/es";
import Chart from "chart.js/auto";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const calendar = ref(null);
const showEventModal = ref(false);
const eventoAct = ref({
    title: "",
    start: "",
    end: "",
    allDay: false,
    extendedProps: {
        description: "",
    },
});

const calendarOptions = ref({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, listPlugin],
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

    height: "auto",
    contentHeight: "auto",
    events: "/appointments/list",
    weekNumbers: false,
    eventClick: handleEventClick,
    fixedWeekCount: false,
    editable: false,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    locale: "es",
    buttonText: {
        today: "Hoy",
        month: "Mes",
        week: "Semana",
        day: "Día",
        list: "Lista",
    },
    eventColor: "#f97316",
    eventTextColor: "#ffffff",

    firstDay: 1, // Lunes como primer día de la semana
    editable: false, // Permite arrastrar y soltar eventos
    selectable: false, // Permite seleccionar intervalos de tiempo
});

function handleEventClick(clickInfo) {
    const formatForInput = (date) => {
        if (!date) return "";
        const d = new Date(date);
        const pad = (n) => n.toString().padStart(2, "0");
        return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(
            d.getDate()
        )}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
    };

    eventoAct.value = {
        id: clickInfo.event.id,
        title: clickInfo.event.title,
        start: formatForInput(clickInfo.event.start),
        end: formatForInput(clickInfo.event.end),
        allDay: clickInfo.event.allDay,
        extendedProps: {
            description: clickInfo.event.extendedProps.description || "",
        },
    };
    showEventModal.value = true;
}

onMounted(() => {
    // const calendarEl = document.getElementById("calendar");
    // const calendar = new Calendar(calendarEl, {
    //     plugins: [
    //         dayGridPlugin,
    //         timeGridPlugin,
    //         interactionPlugin,
    //         googleCalendarPlugin,
    //     ],
    //     initialView: "dayGridMonth",
    //     locale: esLocale,
    //     headerToolbar: {
    //         left: "prev,next today",
    //         center: "title",
    //         right: "dayGridMonth,timeGridWeek,timeGridDay",
    //     },
    //     buttonText: {
    //         today: "Hoy",
    //         month: "Mes",
    //         week: "Semana",
    //         day: "Día",
    //     },
    //     events: {},
    //     eventClick: function (info) {
    //         info.jsEvent.preventDefault(); // previene la navegación

    //         // Puedes personalizar lo que pasa al hacer clic en un evento
    //         console.log("Evento clickeado:", info.event.title);
    //         console.log("Comienza:", info.event.start);
    //         console.log("Termina:", info.event.end);
    //     },
    //     loading: function (bool) {
    //         document.getElementById("loading").style.display = bool
    //             ? "block"
    //             : "none";
    //     },
    //     firstDay: 1, // Lunes como primer día de la semana
    //     businessHours: {
    //         daysOfWeek: [1, 2, 3, 4, 5], // Lunes a Viernes
    //         startTime: "08:00",
    //         endTime: "20:00",
    //     },
    //     editable: true, // Permite arrastrar y soltar eventos
    //     selectable: true, // Permite seleccionar intervalos de tiempo
    // });

    // calendar.render();

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
                    text: "Crecimiento en asistencia del año 2024",
                    font: {
                        size: 16,
                    },
                },
            },
        },
    });
});
</script>

<style scoped>
:deep(.fc-button) {
    background-color: #0072c6 !important;
    color: white !important;
    border: none;
    border-radius: 5px;
    padding: 8px 12px;
    font-size: 14px;
    transition: background 0.3s;
}

:deep(.fc-button:hover) {
    background-color: #0072c6 !important;
}

/* Botón activo (vista seleccionada) */
:deep(.fc-button-active) {
    background-color: #28a745 !important;
    color: white !important;
}

:deep(.fc-button-active) {
    background-color: #28a745 !important;
    color: white !important;
}

/* :deep(.q-menu) {
  z-index: 9999;
} */

:deep(.fc-button) {
    padding: 0.25em 0.4em;
    font-size: 0.8rem;
}

:deep(.fc-toolbar-title) {
    font-size: 1.1rem;
    margin: 0.5rem 0;
}

:deep(.fc) {
    height: 600px;
}

/* Ajustes para tablets */
@media (min-width: 768px) and (max-width: 1024px) {
    :deep(.fc-header-toolbar) {
        flex-direction: column;
        justify-content: center;
        gap: 10px;
    }

    :deep(.fc-toolbar-title) {
        font-size: 1.1rem;
        margin: 0.5rem 0;
        font-weight: 700;
    }

    :deep(.fc-toolbar-chunk:nth-child(2)) {
        order: 3;
        width: 100%;
        text-align: center;
        margin-top: 0.5rem;
    }

    :deep(.fc) {
        height: 900px;
    }
}

/* Ajustes para teléfonos */
@media (max-width: 767px) {
    :deep(.fc-header-toolbar) {
        flex-direction: column;
        justify-content: center;
        gap: 10px;
    }

    :deep(.fc-toolbar-title) {
        font-size: 1.1rem;
        margin: 0.5rem 0;
        font-weight: 700;
    }

    :deep(.fc-toolbar-chunk:nth-child(2)) {
        order: 3;
        width: 100%;
        text-align: center;
        margin-top: 0.5rem;
    }

    :deep(.fc) {
        height: 900px;
    }
}
</style>
