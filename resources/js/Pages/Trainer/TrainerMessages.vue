<template>
    <div class="min-h-screen bg-gray-100 p-6 flex flex-col items-center">
        <h1>PENDIENTE!!!!!!</h1>
        <!-- Encabezado -->
        <!-- <h1 class="text-3xl font-bold text-gray-800 mb-6">💬 Mensajes</h1> -->

        <!-- <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg flex overflow-hidden"> -->
        <!-- Lista de chats -->
        <!-- <div class="w-1/3 border-r p-4 bg-gray-50">
                <h2 class="text-xl font-semibold mb-4">Chats</h2>
                <ul>
                    <li v-for="(chat, index) in chats" :key="index" 
                        @click="seleccionarChat(chat)"
                        class="p-3 flex justify-between items-center rounded-lg cursor-pointer hover:bg-gray-200 transition"
                        :class="{'bg-blue-200': chatSeleccionado && chat.id === chatSeleccionado.id}"
                    >
                        <span class="font-medium">{{ chat.usuario }}</span>
                        <span v-if="chat.noLeidos > 0" class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                            {{ chat.noLeidos }}
                        </span>
                    </li>
                </ul>
            </div> -->

        <!-- Ventana de chat -->
        <!-- <div class="w-2/3 p-4 flex flex-col">
                <div v-if="chatSeleccionado" class="flex-1">
                    <h2 class="text-xl font-semibold mb-2 border-b pb-2">
                        Chat con {{ chatSeleccionado.usuario }}
                    </h2>
                    <div class="h-80 overflow-y-auto p-2 space-y-3">
                        <div v-for="(mensaje, index) in chatSeleccionado.mensajes" :key="index" 
                            class="p-3 rounded-lg max-w-xs"
                            :class="mensaje.envio === 'trainer' ? 'bg-blue-500 text-white self-end ml-auto' : 'bg-gray-200 text-gray-800'"
                        >
                            {{ mensaje.texto }}
                        </div>
                    </div>
                </div>
                <div v-else class="flex-1 flex items-center justify-center text-gray-500">
                    Selecciona un chat para ver los mensajes
                </div> -->

        <!-- Área de respuesta -->
        <!-- <div class="mt-4 flex">
                    <input v-model="nuevoMensaje" type="text" placeholder="Escribe un mensaje..."
                        class="w-full p-3 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button @click="enviarMensaje" 
                        class="bg-blue-500 text-white px-4 py-3 rounded-r-lg hover:bg-blue-600 transition">
                        📩
                    </button>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script setup>
import { ref } from "vue";

// Datos simulados de chats
const chats = ref([
    {
        id: 1,
        usuario: "Carlos López",
        noLeidos: 2,
        mensajes: [
            { texto: "Hola! Necesito ayuda con mi plan.", envio: "usuario" },
            { texto: "¡Por supuesto! ¿Qué necesitas?", envio: "trainer" },
        ],
    },
    {
        id: 2,
        usuario: "María Fernández",
        noLeidos: 1,
        mensajes: [{ texto: "¿Puedes enviarme una rutina?", envio: "usuario" }],
    },
]);

const chatSeleccionado = ref(null);
const nuevoMensaje = ref("");

// Función para seleccionar chat
const seleccionarChat = (chat) => {
    chatSeleccionado.value = chat;
    chat.noLeidos = 0; // Marcar como leído
};

// Función para enviar mensaje
const enviarMensaje = () => {
    if (chatSeleccionado.value && nuevoMensaje.value.trim() !== "") {
        chatSeleccionado.value.mensajes.push({
            texto: nuevoMensaje.value,
            envio: "trainer",
        });
        nuevoMensaje.value = ""; // Limpiar input
    }
};
</script>

<style scoped>
/* Animación de entrada */
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
</style>
