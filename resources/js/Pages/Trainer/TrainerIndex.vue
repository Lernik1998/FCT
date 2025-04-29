<template>
    <!-- Contenido principal -->
    <main class="container mx-auto py-8 px-4 sm:px-6 dark:bg-gray-800 dark:text-gray-600">
        <!-- Bienvenida -->
        <div class="mb-10 bg-white rounded-xl shadow-lg p-6 animate-fade-in">
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-center"
            >
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                        <!-- ¡Bienvenido, {{ trainer.name }}! -->
                    </h1>
                    <!-- <p class="text-gray-600 mt-2">
                        Gestiona tus actividades y sigue el progreso de tus
                        clientes
                    </p> -->
                </div>
                <!-- 
                Si el campo is_active está en 1 mostrar esto, sino mostrar el mensaje de desactivación
                <div class="mt-4 md:mt-0 flex items-center">
                    <span
                        class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full flex items-center"
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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        Entrenador verificado
                    </span>
                </div> -->
            </div>
        </div>

        <!-- Gestión de actividades -->
        <section
            class="mb-10 bg-white rounded-xl shadow-lg overflow-hidden animate-slide-in"
        >
            <div
                class="p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center"
            >
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 mr-2 text-orange-500"
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
                    Calendario de actividades
                </h2>
            </div>

            <div class="p-6 bg-gray-50">
                <div
                    class="alert bg-blue-50 text-blue-800 p-4 rounded-lg border border-blue-100 mb-6"
                >
                    <FullCalendar
                        ref="calendar"
                        class="trainer-calendar"
                        :options="calendarOptions"
                    />

                    <!-- <div class="flex items-start">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <div>
                            <h4 class="font-bold">Aprobación de actividades</h4>
                            <p class="text-sm">
                                Todas las nuevas actividades deben ser aprobadas
                                por el administrador antes de ser publicadas.
                                Recibirás una notificación cuando tu actividad
                                sea revisada.
                            </p>
                        </div>
                    </div> -->
                </div>

                <!-- Lista de actividades -->
                <!-- <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <div
                        v-for="i in 1"
                        :key="i"
                        class="bg-white rounded-lg border border-gray-200 p-4 hover:border-orange-300 transition-colors"
                    >
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800">
                                Entrenamiento Funcional Avanzado
                            </h3>
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full"
                                >Pendiente</span
                            >
                        </div>
                        <p class="text-sm text-gray-600 mt-2">
                            Lunes y Miércoles - 18:00 a 19:30
                        </p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm text-gray-500"
                                >12 plazas disponibles</span
                            >
                            <button
                                class="text-sm text-orange-500 hover:text-orange-700"
                            >
                                Editar
                            </button>
                        </div> -->
            </div>

            <!-- <div
                        v-for="i in 3"
                        :key="i + 3"
                        class="bg-white rounded-lg border border-gray-200 p-4 hover:border-orange-300 transition-colors"
                    >
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800">
                                Yoga Matutino
                            </h3>
                            <span
                                class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full"
                                >Aprobado</span
                            >
                        </div>
                        <p class="text-sm text-gray-600 mt-2">
                            Martes y Jueves - 8:00 a 9:00
                        </p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm text-gray-500"
                                >5 plazas disponibles</span
                            >
                            <button
                                class="text-sm text-orange-500 hover:text-orange-700"
                            >
                                Editar
                            </button>
                        </div>
                    </div> 
                </div>
            </div> -->
        </section>

        <!-- Estadísticas y gráficos -->
        <section
            class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-in"
        >
            <!-- <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 mr-2 text-orange-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                        />
                    </svg>
                    Estadísticas y Progreso
                </h2>
            </div>

            <TrainerChart /> -->

            <!-- <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-3">Participación en tus actividades</h3>
                    <TrainerChart />
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Clientes nuevos</h3>
                        <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center text-gray-400">
                            [Gráfico de clientes nuevos]
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Evaluación promedio</h3>
                        <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center text-gray-400">
                            [Gráfico de evaluaciones]
                        </div>
                    </div>
                </div>
            </div> -->
        </section>

        <section>
            <!-- Modal para crear/editar/eliminar eventos -->
            <div
                v-if="showEventModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                    <div
                        class="p-5 border-b border-gray-200 flex justify-between items-center"
                    >
                        <h3 class="text-lg font-semibold text-gray-800">
                            Actividad
                        </h3>
                        <button
                            @click="closeEventModal"
                            class="text-gray-500 hover:text-gray-700"
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
                                class="block text-sm font-medium text-gray-700 mb-1"
                                >Título del evento</label
                            >
                            {{ eventoAct.title }}
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Fecha inicio</label
                                >
                                {{ eventoAct.start }}
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Fecha fin</label
                                >
                                {{ eventoAct.end }}
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1"
                                >Descripción</label
                            >
                            {{ eventoAct.extendedProps.description }}
                        </div>

                        <div>
                            <label class="flex items-center">
                                <span class="ml-2 text-sm text-gray-700">
                                    {{
                                        eventoAct.allDay
                                            ? "Todo el día"
                                            : "Por hora"
                                    }}</span
                                >
                            </label>
                        </div>
                    </div>

                    <div
                        class="p-5 border-t border-gray-200 flex justify-end space-x-3"
                    >
                        <button
                            @click="closeEventModal"
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                        >
                            Cerrar
                        </button>

                        <button
                            v-if="showAct"
                            @click="deleteEvent"
                            class="px-4 py-2 border border-blue-300 rounded-md text-blue-700 hover:bg-blue-50"
                        >
                            Gestionar
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
// import TrainerChart from "./Components/ActivityTrainerChart.vue";
import TrainerLayout from "@/Layouts/TrainerLayout.vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import { ref, onMounted } from "vue";
import { router } from "@inertiajs/vue3";

defineOptions({
    layout: TrainerLayout,
});

// Props
// defineProps({
//     trainer: {
//         type: Object,
//         required: true,
//     },
// });

// Configuración del calendario
const calendar = ref(null);
const showEventModal = ref(false);
const showAct = ref(false);
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
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
    },
    firstDay: 1,
    height: "auto",
    contentHeight: "auto",
    events: "/appointments/list",

    eventClick: function (info) {
        handleEventClick(info);
    },
    editable: false,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    // select: handleDateSelect,
    locale: "es",
    buttonText: {
        today: "Hoy",
        month: "Mes",
        week: "Semana",
        day: "Día",
        list: "Lista de actividades",
    },
    eventColor: "#f97316",
    eventTextColor: "#ffffff",
});

function handleEventClick(clickInfo) {
    showAct.value = true;

    // Convertir fechas a formato local para mostrarlas correctamente en el input datetime-local
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
        // FIXME: Pendiente que obtenga correctamente la hora en la ficha de evento
        start: formatForInput(clickInfo.event.start),
        end: formatForInput(clickInfo.event.end),
        allDay: clickInfo.event.allDay,
        extendedProps: {
            description: clickInfo.event.extendedProps.description || "",
        },
    };
    showEventModal.value = true;
}

function closeEventModal() {
    showEventModal.value = false;
}

onMounted(() => {
    // Cargar eventos desde la API aquí
    console.log("Calendario montado");
});
</script>

<style scoped>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-in {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-slide-in {
    animation: slide-in 0.6s ease-out;
}

.transition-colors {
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Calendario */
.trainer-calendar {
    width: 100%;
    min-height: 600px;
}

.fc-event {
    cursor: pointer;
    border-radius: 4px;
    padding: 2px 5px;
}

.fc-daygrid-event {
    margin-bottom: 2px;
}

.fc-toolbar-title {
    font-size: 1.25rem;
    font-weight: 600;
}

.fc-button {
    background-color: #f97316 !important;
    border-color: #f97316 !important;
    color: white !important;
    padding: 0.4em 0.65em !important;
    font-size: 0.9em !important;
}

.fc-button:hover {
    background-color: #ea580c !important;
    border-color: #ea580c !important;
}

.fc-button-active {
    background-color: #c2410c !important;
    border-color: #c2410c !important;
}

.fc-today-button {
    background-color: #f97316 !important;
    border-color: #f97316 !important;
}

.fc-today-button:hover {
    background-color: #ea580c !important;
    border-color: #ea580c !important;
}
</style>
