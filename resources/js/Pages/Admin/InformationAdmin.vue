<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Head -->
        <Head :title="'Panel de Administración'" />

        <!-- Barra de navegación -->
        <!-- <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800">Panel de Administración</div>
                <AdminNavBar :notifications="numNotifs" />
            </div>
        </nav> -->

        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <!-- Encabezado -->
            <div class="mb-8">
                <h1 class="text-2xl font-semibold text-gray-800 mb-2">
                    Gestiona los mensajes asignándolos a un entrenador o respondiéndolos
                </h1>
                <h2 class="text-xl font-medium text-gray-600">Notificaciones</h2>
            </div>

            <!-- Mensaje de estado -->
            <div v-if="messageStatus" class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
                {{ messageStatus }}
            </div>

            <!-- Modales -->
            <ConfirmationModal
                :show="show"
                @close="show = false"
                :max-width="'2xl'"
                :closeable="true"
                :title="'Confirmación'"
                :content="messageStatus"
                :footer="'Haga click fuera de la casilla para cerrar'"
            />

            <ConfirmationModal
                :show="showAssigned"
                @close="showAssigned = false"
                :max-width="'2xl'"
                :closeable="true"
                :title="'Asignación'"
                :content="'Entrenador asignado correctamente'"
                :footer="'Haga click fuera de la casilla para cerrar'"
            />

            <!-- Lista de mensajes -->
            <div v-if="messages.length > 0" class="space-y-6">
                <div
                    v-for="(message, index) in messages"
                    :key="index"
                    class="bg-white p-6 rounded-lg shadow-sm border border-gray-200"
                >
                    <div class="space-y-2 mb-4">
                        <p class="text-gray-800">
                            <span class="font-semibold">De:</span> {{ message.name || "Anónimo" }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Mensaje:</span> {{ message.message }}
                        </p>
                    </div>

                    <!-- Asignar entrenador -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Asignar a:</label>
                        <select
                            v-model="message.assignedTrainer"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">Seleccionar entrenador</option>
                            <template v-if="trainers.length > 0">
                                <option
                                    v-for="trainer in trainers"
                                    :key="trainer.id"
                                    :value="trainer"
                                    class="py-1"
                                >
                                    {{ trainer.name }}
                                </option>
                            </template>
                            <template v-else>
                                <option disabled class="py-1">
                                    No hay entrenadores registrados
                                </option>
                            </template>
                        </select>
                    </div>

                    <!-- Responder mensaje -->
                    <div class="mb-4">
                        <textarea
                            v-model="message.reply"
                            placeholder="Escribe tu respuesta..."
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        ></textarea>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-wrap gap-3">
                        <button
                            @click="sendReply(index)"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                        >
                            Enviar Respuesta
                        </button>
                        <button
                            @click="markAsResolved(index)"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors"
                        >
                            Asignar a un entrenador
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estado vacío -->
            <div v-else class="bg-white p-8 rounded-lg shadow-sm border border-gray-200 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <p class="text-gray-500 text-lg">No hay nuevas notificaciones</p>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import AdminNavBar from "./Components/AdminNavBar.vue";
import ConfirmationModal from "../../Components/ConfirmationModal.vue";

const props = defineProps(["messages", "trainers", "messageStatus"]);

// Componentes
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const messages = ref([...props.messages]);
const trainers = ref(props.trainers);
const show = ref(false);
const messageStatus = ref(props.messageStatus);
const showAssigned = ref(false);
const numNotifs = ref(parseInt(messages.value.length));

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
};

const markAsResolved = (index) => {
    if (!messages.value[index].assignedTrainer) {
        alert("Por favor, asigna un entrenador al mensaje");
        return;
    }

    router.post(route("admin.markAsAssigned"), {
        id: messages.value[index].id,
        trainer_id: messages.value[index].assignedTrainer.id,
    });
    showAssigned.value = true;
};

watch(
    () => props.messages,
    (newMessages) => {
        messages.value = [...newMessages];
        numNotifs.value = parseInt(newMessages.length);
    }
);
</script>