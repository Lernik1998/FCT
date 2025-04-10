<template>
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

        <!-- Modal para crear/editar eventos -->
        <div
            v-if="showEventModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                <div
                    class="p-5 border-b border-gray-200 flex justify-between items-center"
                >
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ editingEvent ? "Editar Evento" : "Nuevo Evento" }}
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
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";

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

    // events: "/appointments/list",
    // eventDidMount: function (info) {
    //     info.el.addEventListener("click", () => {
    //         handleEventClick(info);
    //     });
    // },

    // eventDrop: async function (info) { Va, pero por ahora lo comento
    //     try {
    //         await axios.put(`/api/calendar-events/${info.event.id}`, {
    //             title: info.event.title,
    //             start: info.event.start.toISOString(),
    //             end: info.event.end.toISOString(),
    //             description: info.event.extendedProps.description,
    //         });
    //         info.event.setExtendedProps({
    //             updated: true,
    //         });
    //     } catch (error) {
    //         console.error("Error al mover evento:", error);
    //     }
    // },

    eventResize: async function (info) {
        try {
            await axios.put(`/api/calendar-events/${info.event.id}`, {
                title: info.event.title,
                start: info.event.start.toISOString(),
                end: info.event.end.toISOString(),
                description: info.event.extendedProps.description,
            });
            info.event.setExtendedProps({
                updated: true,
            });
        } catch (error) {
            console.error("Error al redimensionar evento:", error);
        }
    },
    eventClick: function (info) {
        handleEventClick(info);
    },
    // eventTimeFormat: {
    //     hour: "numeric",
    //     minute: "2-digit",
    //     meridiem: "short",
    // },

    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    select: handleDateSelect,
    // eventClick: handleEventClick,
    // eventDrop: handleEventDrop,
    // eventResize: handleEventResize,
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
    // eventTimeFormat: {
    //     hour: "2-digit",
    //     minute: "2-digit",
    //     meridiem: false,
    //     hour12: false,
    // },
});

// Métodos
function handleDateSelect(selectInfo) {
    editingEvent.value = false;
    eventoAct.value = {
        title: "",
        start: selectInfo.startStr,
        end: selectInfo.endStr,
        allDay: selectInfo.allDay,
        extendedProps: {
            description: "",
        },
    };
    showEventModal.value = true;
}

function handleEventClick(clickInfo) {
    editingEvent.value = true;
    eventoAct.value = {
        id: clickInfo.event.id,
        title: clickInfo.event.title,
        start: clickInfo.event.start
            ? clickInfo.event.start.toISOString().slice(0, 16)
            : "",
        end: clickInfo.event.end
            ? clickInfo.event.end.toISOString().slice(0, 16)
            : "",
        allDay: clickInfo.event.allDay,
        extendedProps: {
            description: clickInfo.event.extendedProps.description || "",
        },
    };
    showEventModal.value = true;
}

// function handleEventDrop(dropInfo) {
//     // Aquí deberías hacer una llamada API para actualizar el evento en el backend
//     console.log("Evento movido:", dropInfo.event);
// }

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
        // Convertir fechas locales a UTC antes de enviar
        const toUTC = (dateString) => {
            if (!dateString) return null;
            const date = new Date(dateString);
            return new Date(
                date.getTime() - date.getTimezoneOffset() * 60000
            ).toISOString();
        };

        console.log("Enviando datos al servidor:", eventoAct.value);

        const eventData = {
            title: eventoAct.value.title,
            start: toUTC(eventoAct.value.start),
            end: toUTC(eventoAct.value.end),
            description: eventoAct.value.extendedProps.description,
            allDay: eventoAct.value.allDay || false,
        };

        if (!eventData.title || !eventData.start || !eventData.end) {
            throw new Error("Faltan campos requeridos");
        }

        let response;
        if (editingEvent.value) {
            response = await axios.put(
                `/appointments/${eventoAct.value.id}`,
                eventData
            );

            // response = await router.put(route("appointments.update", { appointment: eventoAct.value.id }), eventData);
        } else {
            response = await axios.post("/appointmentsStore", eventData);

            // Envio los datos al controlador
            // response = router.post(
            //     route("appointments.store"),
            //     eventData
            // );
        }

        console.log("Respuesta del servidor:", response.data);

        // Mostrar feedback al usuario
        // alert(editingEvent.value ? 'Evento actualizado correctamente' : 'Evento creado correctamente');

        if (response.data.google_calendar_event_id) {
            alert(
                "Evento creado y sincronizado con Google Calendar. ID: " +
                    response.data.google_calendar_event_id
            );
        } else {
            alert(
                "Evento creado localmente pero no se sincronizó con Google Calendar"
            );
        }

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

// Inicialización
onMounted(() => {
    // Puedes cargar eventos desde tu API aquí
    console.log("Calendario montado");
});
</script>

<style>
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
