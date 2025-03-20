<template>
    <div>
        <!-- Barra de navegación -->
        <nav class="p-4 border-b shadow-md bg-white">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">Panel de Administración</div>
                <AdminNavBar />
            </div>
        </nav>

        <section class="p-8">
            <h1 class="text-xl font-semibold mb-10 mt-10">
                Gestiona los mensajes asignándolos a un entrenador o
                respondiéndolos.
            </h1>
            <h2 class="text-xl font-semibold mb-4">Notificaciones</h2>

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
                        Marcar como Resuelto
                    </button>
                </div>
            </div>
            <p v-else class="text-gray-500">No hay nuevas notificaciones.</p>
        </section>
    </div>
</template>

<script setup>
// Importaciones
import { ref } from "vue";
// Componentes
import AdminNavBar from "./Components/AdminNavBar.vue";

// Props
const props = defineProps(["messages", "trainers"]);

// Variables
const messages = ref(props.messages);
const trainers = ref(props.trainers);

// Funciones
const sendReply = (index) => {
    if (messages.value[index].reply.trim() !== "") {
        alert(
            `Respuesta enviada a ${messages.value[index].name || "Anónimo"}: ${
                messages.value[index].reply
            }`
        );
        messages.value[index].reply = "";
    }
};

const markAsResolved = (index) => {
    // messages.value.splice(index, 1);
    // Envio al controlador
    // router.post("/admin/mark-as-resolved", {
    //     id: messages.value[index].id,
    // });
    // // Actualizar el mensaje
    // messages.value[index].isResolved = true;
};
</script>

<style scoped>
textarea {
    resize: none;
}
</style>
