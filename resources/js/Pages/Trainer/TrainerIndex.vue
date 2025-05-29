<template>
    <!-- Contenido principal -->
    <main
        class="container mx-auto py-6 px-4 sm:px-6 lg:px-8 dark:bg-gray-900 min-h-screen"
    >
        <!-- Estado del Entrenador -->
        <section class="mb-8">
            <div
                v-if="trainer.is_active"
                class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border border-green-200 dark:border-green-800"
            >
                <div
                    class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"
                >
                    <div class="flex items-center">
                        <div
                            class="bg-green-100 dark:bg-green-800/30 p-2 rounded-full mr-3"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-green-600 dark:text-green-400"
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
                        </div>
                        <div>
                            <h3
                                class="font-medium text-green-800 dark:text-green-200"
                            >
                                Entrenador Activo
                            </h3>
                            <p
                                class="text-sm text-green-600 dark:text-green-400"
                            >
                                Tienes acceso completo al sistema
                            </p>
                        </div>
                    </div>
                    <p
                        class="text-sm font-medium text-gray-600 dark:text-gray-400"
                        v-if="trainer.category"
                    >
                        Categoría:
                        <span
                            class="font-semibold text-gray-700 dark:text-orange-600"
                            >{{ trainer.category }}</span
                        >
                    </p>
                </div>
            </div>

            <div
                v-else
                class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4 border border-red-200 dark:border-red-800"
            >
                <div
                    class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"
                >
                    <div class="flex items-center">
                        <div
                            class="bg-red-100 dark:bg-red-800/30 p-2 rounded-full mr-3"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-red-600 dark:text-red-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                />
                            </svg>
                        </div>
                        <div>
                            <h3
                                class="font-medium text-red-800 dark:text-red-200"
                            >
                                Entrenador suspendido
                            </h3>
                            <p class="text-sm text-red-600 dark:text-red-400">
                                Tu acceso al sistema está restringido
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto"
                    >
                        <button
                            @click="requestActivation()"
                            class="w-full sm:w-auto text-sm bg-orange-100 dark:bg-orange-700 hover:bg-orange-200 dark:hover:bg-orange-800 text-orange-600 dark:text-orange-400 px-4 py-2 rounded-lg border border-orange-300 dark:border-orange-600 transition-colors duration-300"
                        >
                            Solicitar activación
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section v-if="$page.props.auth.user.is_active === 1">
            <!-- Aviso de categoría -->
            <div
                v-if="!trainer.category || trainer.category === ''"
                class="mb-8 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4 border border-yellow-200 dark:border-yellow-800"
            >
                <div class="flex items-start justify-between">
                    <div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-3 flex-shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                            />
                        </svg>
                        <div>
                            <h3
                                class="font-medium text-yellow-800 dark:text-yellow-200 mb-1"
                            >
                                Categoría no asignada
                            </h3>
                            <p
                                class="text-sm text-yellow-700 dark:text-yellow-400"
                                v-if="categoryRequest === 0"
                            >
                                Actualmente no tienes una categoría asignada.
                                Esto puede afectar a la visibilidad de tus
                                actividades. Por favor, contacta con el
                                administrador para resolver este tema.
                            </p>
                            <p
                                class="text-sm text-yellow-700 dark:text-yellow-400"
                                v-else
                            >
                                Ya se ha solicitado una categoría, el
                                administrador asignará una categoría en breve.
                            </p>
                        </div>
                    </div>
                    <div>
                        <button
                            @click="requestCategory()"
                            v-if="categoryRequest === 0"
                            class="bg-orange-500 hover:bg-orange-600 text-white rounded px-4 py-2"
                        >
                            Solicitar categoría
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Calendario de actividades -->
        <section
            v-if="$page.props.auth.user.is_active === 1"
            class="mb-10 bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden"
        >
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2
                    class="text-xl font-bold text-gray-800 dark:text-white flex items-center"
                >
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

            <div class="p-6 bg-gray-50 dark:bg-gray-700/30">
                <FullCalendar
                    ref="calendar"
                    class="trainer-calendar"
                    :options="calendarOptions"
                />
            </div>
        </section>

        <!-- Modal de evento -->
        <div
            v-if="showEventModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 overflow-y-auto"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-xl mx-auto transition-all"
            >
                <!-- Header -->
                <div
                    class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-700"
                >
                    <h3
                        class="text-lg font-bold text-gray-800 dark:text-white mt-20"
                    >
                        Detalles de la actividad
                    </h3>
                    <button
                        @click="closeEventModal"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
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

                <!-- Body -->
                <div class="p-5 space-y-4">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Título
                        </label>
                        <p class="text-gray-900 dark:text-gray-100">
                            {{ eventoAct.title }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Inicio
                            </label>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ formatDate(eventoAct.start) }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Fin
                            </label>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ formatDate(eventoAct.end) }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Descripción
                        </label>
                        <p class="text-gray-900 dark:text-gray-100">
                            {{
                                eventoAct.extendedProps.description ||
                                "Sin descripción"
                            }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Estado
                        </label>
                        <p class="text-gray-900 dark:text-gray-100">
                            {{
                                eventoAct.extendedProps.status === "active"
                                    ? "Activo"
                                    : "Inactivo"
                            }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Capacidad
                            </label>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{
                                    eventoAct.extendedProps.capacity ||
                                    "Sin capacidad"
                                }}
                            </p>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Plazas disponibles
                            </label>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{
                                    eventoAct.extendedProps.slots ||
                                    "Sin plazas"
                                }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Precio
                        </label>
                        <p class="text-gray-900 dark:text-gray-100">
                            {{ eventoAct.extendedProps.price || "Sin precio" }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Imagen
                        </label>
                        <img
                            :src="
                                'images/activities/' +
                                eventoAct.extendedProps.image
                            "
                            alt="Actividad"
                            class="w-full max-w-xs h-auto rounded-lg shadow-md object-cover"
                        />
                    </div>
                </div>

                <!-- Footer -->
                <div
                    class="flex justify-end p-5 border-t border-gray-200 dark:border-gray-700"
                >
                    <button
                        @click="closeEventModal"
                        class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                    >
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </main>


       <!-- Modal de solicitud de activación -->
        <div
            v-if="showActivationModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md"
            >
                <div
                    class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-700"
                >
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Solicitar Activación
                    </h3>
                    <button
                        @click="showActivationModal = false"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
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

                <div class="p-5">
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        ¿Estás seguro que deseas solicitar la activación de tu
                        cuenta? El administrador revisará tu solicitud y te
                        notificará cuando sea aprobada.
                    </p>

                    <div class="flex justify-end space-x-3">
                        <button
                            @click="showActivationModal = false"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        >
                            Cancelar
                        </button>
                        <button
                            @click="requestActivation"
                            class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors"
                        >
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de solicitud de categoría -->
        <div
            v-if="showCategoryModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md"
            >
                <div
                    class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-700"
                >
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Solicitar Categoría
                    </h3>
                    <button
                        @click="showCategoryModal = false"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
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

                <div class="p-5">
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        ¿Estás seguro que deseas solicitar una categoría? El
                        administrador revisará tu perfil y te asignará una
                        categoría apropiada.
                    </p>

                    <div class="flex justify-end space-x-3">
                        <button
                            @click="showCategoryModal = false"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        >
                            Cancelar
                        </button>
                        <button
                            @click="requestCategory"
                            class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors"
                        >
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de confirmación -->
        <div
            v-if="showConfirmationModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        >
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md"
            >
                <div
                    class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-700"
                >
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Solicitud Enviada
                    </h3>
                    <button
                        @click="showConfirmationModal = false"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
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

                <div class="p-5">
                    <div
                        class="flex items-center justify-center mb-4 text-green-500 dark:text-green-400"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-12 w-12"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 text-center">
                        {{ confirmationMessage }}
                    </p>

                    <div class="flex justify-center mt-6">
                        <button
                            @click="showConfirmationModal = false"
                            class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors"
                        >
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
</template>

<script setup>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import { ref, onMounted, computed } from "vue";
import { router } from "@inertiajs/vue3";
import TrainerLayout from "@/Layouts/TrainerLayout.vue";

defineOptions({
    layout: TrainerLayout,
});

const props = defineProps({
    trainer: Object,
    activities: Array,
    categoryRequest: String,
});

const calendar = ref(null);
const showEventModal = ref(false);
const eventoAct = ref({
    title: "",
    start: "",
    end: "",
    allDay: false,
    extendedProps: {
        description: "",
        image: null,
        price: "0.00",
        slots: 0,
        status: "inactive",
        capacity: 0,
        category_id: null,
    },
});

// Función para detectar si es móvil
const isMobile = computed(() => {
    return window.innerWidth < 768;
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
    events: "/appointments/list/",
    eventClick: handleEventClick,
    eventLimitClick: "popover",
    editable: false,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: 5,
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

    eventClick: function (info) {
        handleEventClick(info);
    },
    dateClick: handleDateClick, // Añadimos el manejador de clic en fecha
});

// Manejador para clic en fecha
function handleDateClick(info) {
    if (isMobile.value) {
        // Si es móvil, cambiamos a vista de semana
        const calendarApi = calendar.value.getApi();
        calendarApi.changeView("listWeek", info.date);
    }
}

async function handleEventClick(clickInfo) {
    const formatForInput = (date) => {
        if (!date) return "";
        const d = new Date(date);
        const pad = (n) => n.toString().padStart(2, "0");
        return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(
            d.getDate()
        )}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
    };

    console.log(clickInfo.event.title);

    const activityData = await getActivityInfo(clickInfo.event.title);

    eventoAct.value = {
        id: clickInfo.event.id,
        title: clickInfo.event.title,
        start: formatForInput(clickInfo.event.start),
        end: formatForInput(clickInfo.event.end),
        allDay: clickInfo.event.allDay,
        extendedProps: {
            description: activityData?.description || "",
            image: activityData?.image || null,
            price: activityData?.price || "0.00",
            slots: activityData?.slots || 0,
            status: activityData?.status || "inactive",
            capacity: activityData?.capacity || null,
            category_id: activityData?.category_id || null,
        },
    };

    showEventModal.value = true;
}

const getActivityInfo = async (name) => {
    const response = await axios.get(`/activity/info/${name}`);
    return response.data;
};

function formatDate(dateString) {
    if (!dateString) return "No especificado";
    const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
    };
    return new Date(dateString).toLocaleString("es-ES", options);
}

function closeEventModal() {
    showEventModal.value = false;
}

function requestActivation() {
    alert("Solicitando activación");
}

function requestCategory() {
    router.post(route("admin.asignCategory", props.trainer.id));
    alert("Solicitando categoría");
}

onMounted(() => {
    console.log("Calendario montado");
});
</script>

<style scoped>
/* Transiciones suaves para dark mode */
.transition-colors {
    transition: background-color 0.3s ease, color 0.3s ease,
        border-color 0.3s ease;
}

/* Estilos para el calendario */
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

:deep(.fc-button-active) {
    background-color: #28a745 !important;
    color: white !important;
}

:deep(.fc-button) {
    padding: 0.25em 0.4em;
    font-size: 0.8rem;
}

:deep(.fc-toolbar-title) {
    font-size: 1.1rem;
    margin: 0.5rem 0;
}

:deep(.fc) {
    height: auto !important;
    min-height: 600px;
}

:deep(.fc-view) {
    min-height: 600px;
}

:deep(.fc-daygrid-day-number) {
    font-weight: bold;
    color: green;
}

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

:deep(.fc-popover) {
    left: auto !important;
    right: 0 !important;
    transform: translateX(-100%) !important;
}
</style>
