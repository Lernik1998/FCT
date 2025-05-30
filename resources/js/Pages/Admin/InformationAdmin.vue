<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Head -->
        <Head :title="'Panel de Administración'" />

        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Encabezado -->
            <div class="mb-8">
                <h1
                    class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-orange-600 mb-2"
                >
                    Gestión de solicitudes
                </h1>
                <h2
                    class="text-lg sm:text-xl font-medium text-gray-600 dark:text-gray-300"
                >
                    Asigne un entrenador o responda directamente
                </h2>
            </div>

            <!-- Mensaje de estado -->
            <div
                v-if="messageStatus"
                class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg border border-green-200 dark:border-green-800"
            >
                {{ messageStatus }}
            </div>

            <!-- Modales -->
            <!-- <ConfirmationModal
                :show="show"
                @close="show = false"
                :max-width="'2xl'"
                :closeable="true"
                :title="'Confirmación'"
                :content="messageStatus"
                :footer="'Haga click fuera de la casilla para cerrar'"
            /> -->

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
            <div v-if="messages.length > 0" class="space-y-4 sm:space-y-6">
                <div
                    v-for="(message, index) in messages"
                    :key="index"
                    class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700"
                >
                    <div class="space-y-2 mb-4">
                        <p class="text-gray-800 dark:text-gray-200">
                            <span class="font-semibold">De:</span>
                            {{ message.name || "Anónimo" }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300">
                            <span class="font-semibold">Mensaje:</span>
                            {{ message.message }}
                        </p>
                    </div>

                    <!-- Asignar entrenador -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >Asignar a:</label
                        >
                        <select
                            v-model="message.assignedTrainer"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="">Seleccionar entrenador</option>
                            <template v-if="trainers.length > 0">
                                <option
                                    v-for="trainer in trainers"
                                    :key="trainer.id"
                                    :value="trainer"
                                    class="py-1 dark:bg-gray-700"
                                >
                                    {{ trainer.name }}
                                </option>
                            </template>
                            <template v-else>
                                <option disabled class="py-1 dark:bg-gray-700">
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
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        ></textarea>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button
                            @click="sendReply(index)"
                            class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors"
                        >
                            Enviar Respuesta
                        </button>
                        <button
                            @click="markAsResolved(index)"
                            class="px-4 py-2 bg-green-600 dark:bg-green-700 text-white rounded-md hover:bg-green-700 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors"
                        >
                            Asignar a un entrenador
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estado vacío -->
            <div
                v-else
                class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-10 sm:h-12 w-10 sm:w-12 mx-auto text-gray-400 dark:text-gray-500 mb-3 sm:mb-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                </svg>
                <p
                    class="text-gray-500 dark:text-gray-400 text-base sm:text-lg"
                >
                    No hay nuevas notificaciones
                </p>
            </div>

            <section>
                <h3
                    class="text-xl sm:text-xl font-semibold text-gray-800 dark:text-orange-600 mb-2 mt-10"
                >
                    Asignación de categoría
                </h3>

                <div
                    v-if="categories.length > 0"
                    class="space-y-4 sm:space-y-6"
                >
                    <div
                        v-for="category in categories"
                        :key="category.id"
                        class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700"
                    >
                        <div class="space-y-2 mb-4">
                            <p class="text-gray-800 dark:text-gray-200">
                                <span class="font-semibold">De:</span>
                                {{ category.name || "Anónimo" }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-semibold">Mensaje:</span>
                                {{ category.message }}
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <button
                                @click="
                                    router.get(
                                        route(
                                            'admin.trainerShow',
                                            category.trainer_id
                                        )
                                    )
                                "
                                class="px-4 py-2 bg-green-600 dark:bg-green-700 text-white rounded-md hover:bg-green-700 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors"
                            >
                                Asignar
                            </button>
                            <button
                                @click="
                                    router.post(
                                        route(
                                            'admin.markAsDone',
                                            category.trainer_id
                                        )
                                    )
                                "
                                class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors"
                            >
                                Realizado
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Estado vacío -->
                <div
                    v-else
                    class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center"
                >
                    <p
                        class="text-gray-500 dark:text-gray-400 text-base sm:text-lg"
                    >
                        No hay solicitudes de categoría
                    </p>
                </div>
            </section>

            <section>
                <h3
                    class="text-xl sm:text-xl font-semibold text-gray-800 dark:text-orange-600 mb-2 mt-10"
                >
                    Activación
                </h3>

                <div v-if="activations.length > 0" class="space-y-4">
                    <div
                        v-for="activation in activations"
                        :key="activation.id"
                        class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700"
                    >
                        <div class="flex justify-between items-start">
                            <div>
                                <p
                                    class="font-medium text-gray-800 dark:text-gray-200"
                                >
                                    {{ activation.trainer.name }}
                                </p>
                                <p
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    {{ activation.trainer.email }}
                                </p>
                                <p
                                    class="mt-2 text-gray-700 dark:text-gray-300"
                                >
                                    {{ activation.message }}
                                </p>
                            </div>
                            <div class="flex justify-between">
                                <button
                                    @click="
                                        router.get(
                                            route(
                                                'admin.trainerShow',
                                                activation.trainer_id
                                            )
                                        )
                                    "
                                    class="px-4 py-2 bg-green-600 dark:bg-green-700 text-white rounded-md hover:bg-green-700 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors"
                                >
                                    Asignar
                                </button>
                                <button
                                    @click="
                                        router.post(
                                            route(
                                                'admin.markAsDone',
                                                activation.trainer_id
                                            )
                                        )
                                    "
                                    class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors"
                                >
                                    Realizado
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Estado vacío -->
                <div
                    v-else
                    class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center"
                >
                    <p
                        class="text-gray-500 dark:text-gray-400 text-base sm:text-lg"
                    >
                        No hay solicitudes de activación
                    </p>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal personalizado para errores -->
    <div
        v-if="showErrorModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
    >
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full p-6 border border-red-500 dark:border-red-600"
        >
            <div class="flex items-start justify-between mb-4">
                <h3
                    class="text-lg font-semibold text-red-600 dark:text-red-500"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 inline mr-2"
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
                    Error
                </h3>
                <button
                    @click="showErrorModal = false"
                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
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
            <div class="text-gray-700 dark:text-gray-300 mb-6">
                Por favor, escribe una respuesta antes de enviar.
            </div>
            <div class="flex justify-end">
                <button
                    @click="showErrorModal = false"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors"
                >
                    Entendido
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import ConfirmationModal from "../../Components/ConfirmationModal.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps([
    "messages",
    "trainers",
    "messageStatus",
    "categories",
    "activations",
]);

const messages = ref([...props.messages]);
const trainers = ref(props.trainers);
const show = ref(false);
const messageStatus = ref(props.messageStatus);
const showAssigned = ref(false);
const numNotifs = ref(parseInt(messages.value.length));
const showErrorModal = ref(false);

const sendReply = (index) => {
    const message = messages.value[index];

    if (!message || !message.reply || message.reply.trim() === "") {
        showErrorModal.value = true;
        return;
    }

    router.post(route("admin.sendReplyUnregisteredUser"), {
        id: message.id,
        reply: message.reply,
    });

    message.reply = "";
    show.value = true;

    window.location.reload();
};

watch(
    () => props.messages,
    (newMessages) => {
        messages.value = [...newMessages];
        numNotifs.value = parseInt(newMessages.length);
    }
);
</script>
