<template>
    <Head title="Calendario de actividades" />

    <!-- Contenido principal -->
    <main
        class="px-4 sm:px-6 lg:px-8 py-6 dark:bg-gray-900 min-h-screen transition-colors duration-300"
    >
        <!-- Normas para creación de actividades -->
        <div
            class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md mb-6 transition-colors duration-300"
        >
            <h3
                class="text-lg font-semibold mb-3 text-gray-800 dark:text-orange-400"
            >
                Normas para la creación de actividades:
            </h3>
            <ul
                class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1 text-sm sm:text-base"
            >
                <li>
                    Si ya existe una actividad con el mismo nombre, introducir
                    el mismo nombre para que no se creen actividades duplicadas.
                </li>
                <li>La actividad debe tener un título claro y descriptivo.</li>
                <li>Debe incluir una fecha y hora de inicio definidas.</li>
                <li>
                    Se requiere una descripción con el objetivo de la actividad.
                </li>
                <li>
                    No se permiten actividades duplicadas o con contenido
                    similar en horarios solapados.
                </li>
                <li>El aforo máximo debe estar definido si aplica.</li>
                <li>Se debe de añadir una imagen o icono representativo.</li>
                <li>
                    Hable con el administrador para eliminar o editar
                    actividades.
                </li>
            </ul>
        </div>

        <!-- Mensaje de estado -->
        <!-- <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md mb-6 transition-colors duration-300">
            <p class="text-gray-700 dark:text-gray-300 text-sm sm:text-base">
                En funcionamiento con lernik10@gmail.com pendiente asignar permisos al resto de usuarios
            </p>
            
             Verifico mensaje de exito o error 
            <div v-if="success !== null" class="mt-3">
                <p v-if="success" class="text-green-600 dark:text-green-400">Conexión exitosa con Google Calendar</p>
                <p v-else class="text-red-600 dark:text-red-400">Error al conectar con Google Calendar</p>
            </div>
        </div> -->

        <!-- Calendario de actividades -->
        <div
            class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md transition-colors duration-300"
        >
            <div
                class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4 sm:mb-6"
            >
                <h2
                    class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white"
                >
                    Calendario de actividades
                </h2>
                <button
                    @click="handleNewEventClick"
                    class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 dark:bg-orange-600 dark:hover:bg-orange-700 text-white px-4 py-2 rounded-md flex items-center justify-center transition-colors duration-200"
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
                    Nueva actividad
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
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300 p-4"
            >
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4 transition-all duration-300 border border-gray-200 dark:border-gray-700 max-h-[90vh] overflow-y-auto"
                >
                    <div
                        class="p-4 sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center z-10"
                    >
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-white"
                        >
                            {{
                                editingEvent
                                    ? "Editar actividad"
                                    : "Nueva actividad"
                            }}
                        </h3>
                        <button
                            @click="closeEventModal"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors duration-200"
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

                    <div class="p-4 space-y-4">
                        <!-- Nombre de la actividad -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >
                                Nombre de la actividad
                            </label>
                            <input
                                v-model="eventoAct.title"
                                type="text"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200"
                                placeholder="Entrenamiento de..."
                            />
                        </div>

                        <!-- Fechas -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >
                                    Fecha inicio
                                </label>
                                <input
                                    v-model="eventoAct.start"
                                    type="datetime-local"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200"
                                />
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >
                                    Fecha fin
                                </label>
                                <input
                                    v-model="eventoAct.end"
                                    type="datetime-local"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200"
                                />
                            </div>
                        </div>

                        <!-- Precio y capacidad -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >
                                    Precio
                                </label>
                                <input
                                    min="1"
                                    type="number"
                                    v-model="eventoAct.price"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500"
                                />
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                                >
                                    Capacidad
                                </label>
                                <input
                                    min="1"
                                    type="number"
                                    v-model="eventoAct.capacity"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500"
                                />
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >
                                Descripción
                            </label>
                            <textarea
                                v-model="eventoAct.extendedProps.description"
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200"
                                placeholder="Detalles del evento..."
                            ></textarea>
                        </div>

                        <!-- Imagen -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >
                                Imagen
                            </label>
                            <input
                                type="file"
                                @change="handleImageChange"
                                required
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 dark:file:bg-gray-700 dark:file:text-orange-300 dark:hover:file:bg-gray-600"
                            />
                        </div>
                    </div>

                    <!-- Botones -->
                    <div
                        class="p-4 sticky bottom-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3"
                    >
                        <button
                            @click="closeEventModal"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 w-full sm:w-auto"
                        >
                            Cancelar
                        </button>
                        <!-- <button
                            v-if="editingEvent"
                            @click="deleteEvent"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 text-white rounded-md transition-colors duration-200 w-full sm:w-auto"
                        >
                            Eliminar
                        </button> -->
                        <button
                            @click="saveEvent"
                            class="px-4 py-2 bg-orange-500 hover:bg-orange-600 dark:bg-orange-600 dark:hover:bg-orange-700 text-white rounded-md transition-colors duration-200 w-full sm:w-auto"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { onMounted } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import TrainerLayout from "@/Layouts/TrainerLayout.vue";

defineOptions({
    layout: TrainerLayout,
});

defineProps({
    message: Boolean,
});

// Formatear fecha
const formatDate = (dateString) => {
    const options = { year: "numeric", month: "short", day: "numeric" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
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
    price: 0,
    capacity: 0,
    image: null,
    extendedProps: {
        description: "",
    },
});

function handleImageChange(event) {
    const file = event.target.files[0];
    if (file) {
        // Aquí podrías validar el tipo de archivo o tamaño si es necesario
        eventoAct.value.image = file;
    }
}

// Opciones del calendario
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
    eventDrop: handleEventDrop,
    eventResize: handleEventResize,

    eventClick: function (info) {
        handleEventClick(info);
    },

    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: 3,
    fixedWeekCount: false,
    weekNumbers: false,
    // weekends: true,
    select: handleDateSelect,
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
        // allDay: selectInfo.allDay,
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

        // const eventData = {
        //     title: eventoAct.value.title,
        //     start: formatDateForBackend(eventoAct.value.start),
        //     end: formatDateForBackend(eventoAct.value.end),
        //     description: eventoAct.value.extendedProps.description,
        //     allDay: eventoAct.value.allDay || false,
        // };

        // if (!eventData.title || !eventData.start || !eventData.end) {
        //     throw new Error("Faltan campos requeridos");
        // }

        // Crear FormData para manejar la imagen y otros datos
        const formData = new FormData();

        // Añadir los campos básicos
        formData.append("title", eventoAct.value.title);
        formData.append("start", formatDateForBackend(eventoAct.value.start));
        formData.append("end", formatDateForBackend(eventoAct.value.end));
        formData.append(
            "description",
            eventoAct.value.extendedProps.description || ""
        );
        formData.append("allDay", eventoAct.value.allDay || false);

        // Añadir los nuevos campos
        formData.append("price", eventoAct.value.price || 0);
        formData.append("capacity", eventoAct.value.capacity || 0);

        // Añadir la imagen si existe
        if (eventoAct.value.image) {
            formData.append("image", eventoAct.value.image);
        }

        if (
            !eventoAct.value.title ||
            !eventoAct.value.start ||
            !eventoAct.value.end
        ) {
            throw new Error("Faltan campos requeridos");
        }

        if (editingEvent.value) {
            // Actualizar

            await router.put(
                route("appointments.update", {
                    appointment: eventoAct.value.id,
                }),
                formData,
                {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                }
            );

            // await axios.put(`/appointments/${eventoAct.value.id}`, eventData);
        } else {
            // Crear
            await router.post(route("appointments.store"), formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            });

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
        // console.error("Error al guardar el evento:", error);
        const errorMsg =
            error.response?.data?.message ||
            error.response?.data?.errors ||
            error.message;
        // alert(`Error al guardar: ${JSON.stringify(errorMsg)}`);

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
    height: auto !important;
    min-height: 600px;
}

:deep(.fc-view) {
    min-height: 600px;
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
