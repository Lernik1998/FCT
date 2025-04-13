<template>
    <!-- Barra de navegación mejorada -->
    <nav
        class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg"
    >
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- <img src="/logo-fitworking-white.png" alt="FitWorking Logo" class="h-8"> -->
                <h1 class="text-xl font-bold">Planes Personalizados</h1>
            </div>
            <TrainersNavBar />
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container mx-auto py-8 px-4">
        <!-- Encabezado -->
        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                <span
                    class="bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-red-500"
                >
                    Gestión de planes
                </span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Crea y gestiona planes de entrenamiento personalizados para tus
                clientes
            </p>
        </div>

        <!-- Acciones principales -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-10">
            <!-- :href="route('trainers.createPlan')"  -->
            <a
                class="flex-1 sm:flex-none bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg shadow-md transition-all flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                </svg>
                Crear Nuevo Plan
            </a>

            <button
                @click="showPlanTypeSelector = true"
                class="flex-1 sm:flex-none border-2 border-orange-500 text-orange-500 hover:bg-orange-50 font-medium py-3 px-6 rounded-lg transition-all flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
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
                Filtrar Planes
            </button>
        </div>

        <!-- Lista de planes -->
        <div
            v-if="plans.length > 0"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
        >
            <div
                v-for="plan in filteredPlans"
                :key="plan.id"
                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow border border-gray-200"
            >
                <div class="p-5">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">
                            {{ plan.name }}
                        </h3>
                        <span
                            class="px-3 py-1 rounded-full text-xs font-medium"
                            :class="
                                plan.status
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-gray-100 text-gray-800'
                            "
                        >
                            {{ plan.status ? "Activo" : "Inactivo" }}
                        </span>
                    </div>

                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ plan.description }}
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-orange-500">
                            {{ plan.price ? `${plan.price}€` : "Gratis" }}
                        </span>
                        <div class="flex space-x-2">
                            <!-- :href="route('trainers.editPlan', plan.id)" -->
                            <a
                                class="p-2 text-gray-500 hover:text-orange-500 hover:bg-orange-50 rounded-full transition-colors"
                                title="Editar plan"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>
                            </a>
                            <button
                                @click="togglePlanStatus(plan)"
                                class="p-2 text-gray-500 hover:text-green-500 hover:bg-green-50 rounded-full transition-colors"
                                :title="
                                    plan.status
                                        ? 'Desactivar plan'
                                        : 'Activar plan'
                                "
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
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
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-gray-50 px-5 py-3 border-t border-gray-200 flex justify-between items-center"
                >
                    <span class="text-sm text-gray-500">
                        {{ formatDate(plan.created_at) }}
                    </span>
                    <span
                        class="text-xs px-2 py-1 rounded"
                        :class="
                            plan.type === 'free'
                                ? 'bg-blue-100 text-blue-800'
                                : 'bg-purple-100 text-purple-800'
                        "
                    >
                        {{
                            plan.type === "free"
                                ? "Plan Público"
                                : "Plan Privado"
                        }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Sin planes -->
        <div v-else class="bg-white rounded-xl shadow-sm p-10 text-center">
            <div class="mx-auto max-w-md">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-16 w-16 mx-auto text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                    />
                </svg>
                <h3 class="text-xl font-medium text-gray-700 mt-4">
                    No hay planes creados
                </h3>
                <p class="text-gray-500 mt-2">
                    Comienza creando tu primer plan personalizado para tus
                    clientes
                </p>
                <a
                    :href="route('trainers.createPlan')"
                    class="mt-6 inline-flex items-center px-4 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-colors"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                        />
                    </svg>
                    Crear Primer Plan
                </a>
            </div>
        </div>

        <!-- Modal para seleccionar tipo de plan -->
        <div
            v-if="showPlanTypeSelector"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4">
                <div
                    class="p-5 border-b border-gray-200 flex justify-between items-center"
                >
                    <h3 class="text-lg font-semibold text-gray-800">
                        Filtrar Planes
                    </h3>
                    <button
                        @click="showPlanTypeSelector = false"
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
                    <div
                        v-for="filter in planFilters"
                        :key="filter.value"
                        @click="
                            selectedFilter = filter.value;
                            showPlanTypeSelector = false;
                        "
                        class="p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 transition-colors"
                        :class="{
                            'border-orange-500 bg-orange-50':
                                selectedFilter === filter.value,
                        }"
                    >
                        <div class="flex items-center">
                            <div
                                class="mr-3 p-2 rounded-full"
                                :class="filter.bgColor"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    :class="filter.textColor"
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
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">
                                    {{ filter.label }}
                                </h4>
                                <p class="text-sm text-gray-500">
                                    {{ filter.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div>
            <TrainerCalendar />
        </div> -->

        <!-- Verifico mensaje de exito o error
        <div v-if="success !== null">
            <p v-if="success" class="text-green-500">
                Conexión exitosa con Google Calendar
            </p>
            <p v-else class="text-red-500">
                Error al conectar con Google Calendar
            </p>
        </div> -->

        <div class="bg-white p-4 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">
                    Calendario de Entrenamientos
                </h2>
                <button
                    @click="handleNewEventClick"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md flex items-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-1"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                        />
                    </svg>
                    Nuevo Evento
                </button>
            </div>

            <FullCalendar
                ref="calendar"
                class="trainer-calendar"
                :options="calendarOptions"
            />

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
                            {{
                                editingEvent ? "Editar Evento" : "Nuevo Evento"
                            }}
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
                            <input
                                v-model="eventoAct.title"
                                type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                                placeholder="Sesión de entrenamiento"
                            />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Fecha inicio</label
                                >
                                <input
                                    v-model="eventoAct.start"
                                    type="datetime-local"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                                />
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Fecha fin</label
                                >
                                <input
                                    v-model="eventoAct.end"
                                    type="datetime-local"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1"
                                >Descripción</label
                            >
                            <textarea
                                v-model="eventoAct.extendedProps.description"
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                                placeholder="Detalles del evento..."
                            ></textarea>
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input
                                    v-model="eventoAct.allDay"
                                    type="checkbox"
                                    class="h-4 w-4 text-orange-500 focus:ring-orange-500 border-gray-300 rounded"
                                />
                                <span class="ml-2 text-sm text-gray-700"
                                    >Todo el día</span
                                >
                            </label>
                        </div>
                    </div>

                    <div
                        class="p-5 border-t border-gray-200 flex justify-end space-x-3"
                    >
                        <button
                            @click="closeEventModal"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
                        >
                            Cancelar
                        </button>
                        <button
                            @click="saveEvent"
                            class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600"
                        >
                            Guardar
                        </button>
                        <button
                            v-if="editingEvent"
                            @click="deleteEvent"
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                        >
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import { ref, computed } from "vue";
import TrainersNavBar from "./Components/TrainersNavBar.vue";
import { router } from "@inertiajs/vue3";
import { onMounted } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";

// No los uso por ahora
// defineProps({
//     success: Boolean,
//     error: String,
// });

// const props = defineProps({
//     plans: Array,
// });

const plans = ref([]);
// Estado para filtros
const showPlanTypeSelector = ref(false);
const selectedFilter = ref("all");

// Opciones de filtrado
const planFilters = [
    {
        value: "all",
        label: "Todos los planes",
        description: "Muestra todos tus planes públicos y privados",
        bgColor: "bg-gray-100",
        textColor: "text-gray-500",
    },
    {
        value: "free",
        label: "Planes públicos",
        description: "Planes gratuitos para todos los usuarios",
        bgColor: "bg-blue-100",
        textColor: "text-blue-500",
    },
    {
        value: "private",
        label: "Planes privados",
        description: "Planes personalizados para clientes específicos",
        bgColor: "bg-purple-100",
        textColor: "text-purple-500",
    },
    {
        value: "active",
        label: "Planes activos",
        description: "Muestra solo los planes actualmente activos",
        bgColor: "bg-green-100",
        textColor: "text-green-500",
    },
];

// Filtrar planes según selección
const filteredPlans = computed(() => {
    if (selectedFilter.value === "all") return props.plans;
    if (selectedFilter.value === "active")
        return props.plans.filter((plan) => plan.status);
    return props.plans.filter((plan) => plan.type === selectedFilter.value);
});

// Formatear fecha
const formatDate = (dateString) => {
    const options = { year: "numeric", month: "short", day: "numeric" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

// Cambiar estado del plan
const togglePlanStatus = (plan) => {
    // Aquí iría la lógica para actualizar el estado en el backend
    plan.status = !plan.status;
    // Ejemplo con axios:
    // axios.patch(`/trainer/plans/${plan.id}/status`, { status: !plan.status })
    //   .then(response => plan.status = response.data.status)
};

// Configuración del calendario
const calendar = ref(null);
const showEventModal = ref(false);
const editingEvent = ref(false);
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
    // events: async function (fetchInfo, successCallback, failureCallback) {
    //     try {
    //         const response = await axios.get("/api/calendar-events", {
    //             params: {
    //                 start: fetchInfo.start.toISOString(),
    //                 end: fetchInfo.end.toISOString(),
    //             },
    //         });
    //         successCallback(response.data);
    //     } catch (error) {
    //         failureCallback(error);
    //     }
    // },

    // eventDidMount: function (info) {
    //     info.el.addEventListener("click", () => {
    //         handleEventClick(info);
    //     });
    // },

    eventDrop: handleEventDrop,

    eventResize: handleEventResize,

    eventClick: function (info) {
        handleEventClick(info);
    },

    // eventTimeFormat: {
    //     hour: "numeric",
    //     minute: "2-digit",
    //     meridiem: "short",
    // },
    // eventTimeFormat: {
    //     hour: "2-digit",
    //     minute: "2-digit",
    //     meridiem: false,
    //     hour12: false,
    // },
    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    select: handleDateSelect,
    locale: "es",
    buttonText: {
        today: "Hoy",
        month: "Mes",
        week: "Semana",
        day: "Día",
        list: "Lista de eventos",
    },
    eventColor: "#f97316",
    eventTextColor: "#ffffff",
});

// Métodos
// function handleDateSelect(selectInfo) {
//     editingEvent.value = false;
//     eventoAct.value = {
//         title: "",
//         start: selectInfo.startStr,
//         end: selectInfo.endStr,
//         allDay: selectInfo.allDay,
//         extendedProps: {
//             description: "",
//         },
//     };
//     showEventModal.value = true;
// }

function handleDateSelect(selectInfo) {
    editingEvent.value = false;

    // Formatear la fecha seleccionada para el input datetime-local
    const formatForInput = (date) => {
        const d = new Date(date);
        const pad = (n) => n.toString().padStart(2, "0");
        return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(
            d.getDate()
        )}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
    };

    // Establecer la hora por defecto (por ejemplo, 09:00)
    const startDate = new Date(selectInfo.start);
    startDate.setHours(9, 0, 0, 0); // Establecer a las 9:00 AM

    // Calcular la fecha de fin (1 hora después)
    const endDate = new Date(startDate);
    endDate.setHours(startDate.getHours() + 1);

    eventoAct.value = {
        title: "",
        start: formatForInput(startDate),
        end: formatForInput(endDate),
        allDay: selectInfo.allDay,
        extendedProps: {
            description: "",
        },
    };

    showEventModal.value = true;
}

async function handleEventResize(info) {
    try {
        // Formatear fechas para el backend
        const formatDateForBackend = (date) => {
            if (!date) return null;
            return date.toISOString();
        };

        // Preparar datos para la actualización
        const eventData = {
            title: info.event.title,
            start: formatDateForBackend(info.event.start),
            end: formatDateForBackend(info.event.end),
            description: info.event.extendedProps.description || "",
            allDay: info.event.allDay || false,
        };

        // Llamar a la API para actualizar usando Inertia
        await router.put(
            route("appointments.update", { appointment: info.event.id }),
            eventData,
            {
                preserveScroll: true,
                onSuccess: () => {
                    console.log("Evento redimensionado correctamente");
                    info.event.setExtendedProp("updated", true);
                },
                onError: (errors) => {
                    console.error("Error al redimensionar:", errors);
                    info.revert(); // Revertir el cambio visual
                },
            }
        );
    } catch (error) {
        console.error("Error al redimensionar evento:", error);
        info.revert(); // Revertir el cambio visual

        // Mostrar error al usuario
        const errorMsg =
            error.response?.data?.message ||
            error.message ||
            "Error al redimensionar el evento";
        alert(`Error: ${errorMsg}`);
    }
}

function handleEventClick(clickInfo) {
    editingEvent.value = true;

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

// async function handleEventDrop(info) {
//     try {
//         /*  router.delete(
//             route("appointments.destroy", { appointment: eventoAct.value })
//         );*/

//         await router.put(
//             route("appointments.update", { appointment: eventoAct.value.id }),
//             eventoAct.value
//         );

//         /*
//             await router.put(
//                 route("appointments.update", {
//                     appointment: eventoAct.value.id,
//                 }),
//                 eventData
//             );
//         */

//         info.event.setExtendedProps({
//             updated: true,
//         });
//     } catch (error) {
//         console.error("Error al mover evento:", error);
//     }
// }

async function handleEventDrop(info) {
    try {
        // Formatear fechas para el backend
        const formatDateForBackend = (date) => {
            if (!date) return null;
            return date.toISOString();
        };

        // Preparar datos para la actualización
        const eventData = {
            title: info.event.title,
            start: formatDateForBackend(info.event.start),
            end: formatDateForBackend(info.event.end),
            description: info.event.extendedProps.description || "",
            allDay: info.event.allDay || false,
        };

        // Llamar a la API para actualizar
        await router.put(
            route("appointments.update", { appointment: info.event.id }),
            eventData,
            {
                preserveScroll: true,
                onSuccess: () => {
                    console.log("Evento actualizado correctamente");
                    info.event.setExtendedProp("updated", true);
                },
                onError: (errors) => {
                    console.error("Error al actualizar:", errors);
                    info.revert(); // Revertir el cambio visual
                },
            }
        );
    } catch (error) {
        console.error("Error al mover evento:", error);

        // Revertir el cambio en el calendario si falla la actualización
        info.revert();

        // Mostrar error al usuario
        const errorMsg =
            error.response?.data?.message ||
            error.message ||
            "Error al mover el evento";
        alert(`Error: ${errorMsg}`);
    }
}

// function handleEventResize(resizeInfo) {
//     // Aquí deberías hacer una llamada API para actualizar el evento en el backend
//     console.log("Evento redimensionado:", resizeInfo.event);
// }

function handleNewEventClick() {
    editingEvent.value = false;
    eventoAct.value = {
        title: "",
        start: new Date().toISOString().slice(0, 16),
        end: new Date(new Date().setHours(new Date().getHours() + 1))
            .toISOString()
            .slice(0, 16),
        allDay: false,
        extendedProps: {
            description: "",
        },
    };
    showEventModal.value = true;
}

function closeEventModal() {
    showEventModal.value = false;
}

// async function saveEvent() {
//     try {
//         const eventData = {
//             title: eventoAct.value.title,
//             start: eventoAct.value.start,
//             end: eventoAct.value.end,
//             description: eventoAct.value.extendedProps.description,
//             clientId: eventoAct.value.extendedProps.clientId,
//         };

//         if (editingEvent.value) {
//             // Implementa la actualización si es necesario
//             await axios.put(
//                 `/api/calendar-events/${eventoAct.value.id}`,
//                 eventData
//             );
//         } else {
//             await axios.post("/api/calendar-events", eventData);
//         }

//         // Refresca el calendario
//         if (calendar.value) {
//             calendar.value.getApi().refetchEvents();
//         }

//         closeEventModal();
//     } catch (error) {
//         console.error("Error al guardar el evento:", error);
//         // Puedes mostrar un mensaje de error al usuario
//     }
// }

// async function saveEvent() {
//     try {
//         // Formatear fechas correctamente para el backend
//         const formatDate = (dateString) => {
//             if (!dateString) return null;
//             // Asegurarse que la fecha tiene formato correcto para el backend
//             return new Date(dateString).toISOString();
//         };

//         const eventData = {
//             title: eventoAct.value.title,
//             start: new Date(eventoAct.value.start).toISOString(),
//             end: new Date(eventoAct.value.end).toISOString(),
//             description: eventoAct.value.extendedProps.description,
//             allDay: eventoAct.value.allDay || false, // Asegurar valor booleano
//         };

//         // Validación básica en frontend
//         if (!eventData.title || !eventData.start || !eventData.end) {
//             throw new Error('Faltan campos requeridos');
//         }

//         let response;
//         if (editingEvent.value) {
//             response = await axios.put(`/appointments/${eventoAct.value.id}`, eventData);
//         } else {
//             response = await axios.post("/appointments", eventData);
//         }

//         // Mostrar notificación de éxito
//         console.log('Evento guardado:', response.data);

//         // Cerrar modal y refrescar calendario
//         closeEventModal();
//         if (calendar.value) {
//             calendar.value.getApi().refetchEvents();
//         }
//     } catch (error) {
//         console.error("Error al guardar el evento:", error);
//         // Mostrar error específico al usuario
//         const errorMsg = error.response?.data?.message ||
//                         error.response?.data?.errors ||
//                         error.message;
//         alert(`Error al guardar: ${JSON.stringify(errorMsg)}`);
//     }
// }

async function saveEvent() {
    try {
        // Función para formatear fechas considerando la zona horaria
        const formatDateForBackend = (dateString) => {
            if (!dateString) return null;
            const date = new Date(dateString);

            // Ajustar a la zona horaria local del usuario
            const pad = (n) => n.toString().padStart(2, "0");

            // Obtener componentes de fecha local
            const year = date.getFullYear();
            const month = pad(date.getMonth() + 1);
            const day = pad(date.getDate());
            const hours = pad(date.getHours());
            const minutes = pad(date.getMinutes());

            return `${year}-${month}-${day} ${hours}:${minutes}:00`;
        };

        const eventData = {
            title: eventoAct.value.title,
            start: formatDateForBackend(eventoAct.value.start),
            end: formatDateForBackend(eventoAct.value.end),
            description: eventoAct.value.extendedProps.description,
            allDay: eventoAct.value.allDay || false,
        };

        if (!eventData.title || !eventData.start || !eventData.end) {
            throw new Error("Faltan campos requeridos");
        }

        if (editingEvent.value) {
            // Actualizar

            await router.put(
                route("appointments.update", {
                    appointment: eventoAct.value.id,
                }),
                eventData
            );

            // await axios.put(`/appointments/${eventoAct.value.id}`, eventData);
        } else {
            // Crear
            await router.post(route("appointments.store"), eventData);

            //  = await axios.post("/appointmentsStore", eventData);
        }

        // Mostrar feedback al usuario
        // alert(editingEvent.value ? 'Evento actualizado correctamente' : 'Evento creado correctamente');

        // if (response.data.google_calendar_event_id) {
        //     alert(
        //         "Evento creado y sincronizado con Google Calendar. ID: " +
        //             response.data.google_calendar_event_id
        //     );
        // } else {
        //     alert(
        //         "Evento creado localmente pero no se sincronizó con Google Calendar"
        //     );
        // }

        // Cerrar modal y refrescar calendario
        closeEventModal();
        if (calendar.value) {
            calendar.value.getApi().refetchEvents();
        }
    } catch (error) {
        console.error("Error al guardar el evento:", error);
        const errorMsg =
            error.response?.data?.message ||
            error.response?.data?.errors ||
            error.message;
        alert(`Error al guardar: ${JSON.stringify(errorMsg)}`);

        if (error.response) {
            errorMsg += `: ${
                error.response.data.message || error.response.statusText
            }`;
            if (error.response.data.auth_url) {
                errorMsg += "\n\nSe requiere autorización con Google. ";
                errorMsg += "Por favor abre esta URL en tu navegador:\n";
                errorMsg += error.response.data.auth_url;
            }
        }

        alert(errorMsg);
    }
}

// En tu script setup, añade esta función:
async function deleteEvent() {
    if (!confirm("¿Estás seguro de que quieres eliminar este evento?")) {
        return;
    }

    try {
        // await axios.delete(`/appointments/${eventoAct.value.id}`);
        router.delete(
            route("appointments.destroy", { appointment: eventoAct.value })
        );

        // Cerrar modal y refrescar calendario
        closeEventModal();

        if (calendar.value) {
            calendar.value.getApi().refetchEvents();
        }

        alert("Evento eliminado correctamente");
    } catch (error) {
        console.error("Error al eliminar el evento:", error);
        const errorMsg =
            error.response?.data?.message ||
            error.response?.data?.errors ||
            error.message;
        alert(`Error al eliminar: ${errorMsg}`);
    }
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

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.line-clamp-3 {
    display: -webkit-box;
    /*-webkit-line-clamp: 3; */
    -webkit-box-orient: vertical;
    overflow: hidden;
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
