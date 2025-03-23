<template>
    <!-- Header -->
    <Head>
        <title>Panel de Administración</title>
        <meta name="description" content="Panel de Administración" />
    </Head>

    <div>
        <!-- Barra de navegación -->
        <nav class="p-4 border-b shadow-md bg-white">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">Panel de Administración</div>
                <AdminNavBar :notifications="numNotifs" />
            </div>
        </nav>

        <section class="p-8">
            <h1 class="text-2xl font-semibold mb-10 ml-72">
                Gestiona los mensajes asignándolos a un entrenador o
                respondiéndolos.
            </h1>
            <h2 class="text-xl font-semibold mb-4">Notificaciones</h2>

            <div v-if="messageStatus" class="mb-4">
                <p class="text-green-500" v-if="messageStatus">
                    {{ messageStatus }}
                </p>
            </div>

            <div>
                <!-- Envio de respuesta -->
                <ConfirmationModal
                    :show="show"
                    @close="show = false"
                    :max-width="'2xl'"
                    :closeable="true"
                    :title="'Confirmación'"
                    :content="messageStatus"
                    :footer="'Haga click fuera de la casilla para cerrar'"
                />

                <!-- Asignación de entrenador -->
                <ConfirmationModal
                    :show="showAssigned"
                    @close="showAssigned = false"
                    :max-width="'2xl'"
                    :closeable="true"
                    :title="'Asignación'"
                    :content="'Entrenador asignado correctamente'"
                    :footer="'Haga click fuera de la casilla para cerrar'"
                />
            </div>

            <div v-if="messages.length > 0" class="space-y-4">
                <div
                    v-for="(message, index) in messages"
                    :key="index"
                    class="p-3 border rounded-lg"
                >
                    <p class="text-gray-700">
                        <strong>De:</strong> {{ message.name || "Anónimo" }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Mensaje:</strong> {{ message.message }}
                    </p>

                    <!-- Asignar entrenador -->
                    <label class="block mt-2 text-sm font-medium"
                        >Asignar a:</label
                    >
                    <select
                        v-model="message.assignedTrainer"
                        class="w-full p-2 border rounded"
                    >
                        <option value="">Seleccionar entrenador</option>
                        <template v-if="trainers.length > 0">
                            <option
                                v-for="trainer in trainers"
                                :key="trainer.id"
                                :value="trainer"
                            >
                                {{ trainer.name }}
                            </option>
                        </template>
                        <template v-else>
                            <option disabled>
                                No hay entrenadores registrados
                            </option>
                        </template>
                    </select>

                    <!-- Responder mensaje -->
                    <textarea
                        v-model="message.reply"
                        placeholder="Escribe tu respuesta..."
                        class="w-full p-2 mt-2 border rounded"
                    ></textarea>
                    <button
                        @click="sendReply(index)"
                        class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    >
                        Enviar Respuesta
                    </button>

                    <!-- Marcar como resuelto -->
                    <button
                        @click="markAsResolved(index)"
                        class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2"
                    >
                        Asignar a un entrenador
                    </button>
                </div>
            </div>
            <p v-else class="text-gray-500">No hay nuevas notificaciones.</p>
        </section>
    </div>
</template>

<script setup>
// Importaciones
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3"; // Para el head

// Componentes
import AdminNavBar from "./Components/AdminNavBar.vue";
import ConfirmationModal from "../../Components/ConfirmationModal.vue"; // Modal de confirmación

// Props
const props = defineProps(["messages", "trainers", "messageStatus"]);

// Variables
// const messages = ref(props.messages); --> PARA ESCUCHAR TODOS LOS CAMBIOS DE LA VARIABLE REACTIVA
// Hacer una copia reactiva del array
const messages = ref([...props.messages]);
const trainers = ref(props.trainers);
const show = ref(false);
const messageStatus = ref(props.messageStatus);
const showAssigned = ref(false);
const numNotifs = ref(parseInt(messages.value.length));

// Funciones
const sendReply = (index) => {
    const message = messages.value[index];

    if (!message || !message.reply || message.reply.trim() === "") {
        alert("Por favor, escribe una respuesta");
        return;
    }

    router.post(route("admin.sendReplyUnregisteredUser"), {
        id: message.id,
        reply: message.reply,
    });

    message.reply = "";
    show.value = true;

    /* 
        .then(() => {
            message.reply = ""; // Limpiar el campo tras el envío
            show.value = true; // Mostrar el modal de confirmación
            // messageStatus.value = "Respuesta enviada correctamente";
        })
        .catch((error) => {
            console.error(error);
            // messageStatus.value = "Error al enviar la respuesta";
        });
        */

    // location.reload(); // Refrescar la página --> No es buena práctica
};

const markAsResolved = (index) => {
    // Verificar si se ha asignado un entrenador
    if (!messages.value[index].assignedTrainer) {
        alert("Por favor, asigna un entrenador al mensaje");
        return;
    }

    // Verificar si se ha escrito una respuesta
    // if (!messages.value[index].reply || messages.value[index].reply.trim() === "") {
    //     alert("Por favor, escribe una respuesta");
    //     return;
    // }
    // Envio al controlador
    router.post(route("admin.markAsAssigned"), {
        id: messages.value[index].id,
        trainer_id: messages.value[index].assignedTrainer.id,
    });
    showAssigned.value = true;
};

// Observar cambios en props.messages y sincronizarlos
watch(
    () => props.messages,
    (newMessages) => {
        messages.value = [...newMessages];
        numNotifs.value = parseInt(newMessages.length);
    }
);

// Observar cambios en props.notifications y sincronizarlos
// watch(
//     () => props.notifications,
//     (newNotifications) => {
//         numNotifs.value = parseInt(newNotifications);
//     }
// );
</script>

<style scoped>
textarea {
    resize: none;
}
</style>
