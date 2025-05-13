<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 mt-4">
        <!-- Contenedor principal del chat -->
        <div
            class="max-w-7xl mx-auto flex flex-col md:flex-row h-[calc(100vh-73px)] bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mt-2"
        >
            <!-- Sidebar de usuarios -->
            <div
                class="w-full md:w-1/4 border-b md:border-b-0 md:border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 flex flex-col h-64 md:h-auto"
            >
                <div
                    class="p-4 bg-green-600 text-white font-bold text-lg border-b border-gray-200 dark:border-gray-700"
                >
                    Usuarios
                </div>

                <div class="flex-1 overflow-y-auto p-2 space-y-2">
                    <div
                        v-for="user in users"
                        :key="user.id"
                        @click="selectUser(user)"
                        class="flex items-center p-3 rounded-lg cursor-pointer transition-colors duration-200 hover:bg-gray-100 dark:hover:bg-gray-700"
                        :class="{ 'bg-blue-100 dark:bg-blue-900': user.id === selectedUser?.id }"
                    >
                        <div
                            class="w-10 h-10 bg-blue-200 dark:bg-blue-700 rounded-full flex-shrink-0"
                        ></div>
                        <div class="ml-3">
                            <div class="font-medium text-gray-800 dark:text-gray-100">
                                {{ user.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Área de chat -->
            <div
                class="w-full md:flex-1 flex flex-col border-t md:border-t-0 md:border-l border-gray-200 dark:border-gray-700 h-full"
            >
                <!-- Estado vacío -->
                <div
                    v-if="!selectedUser"
                    class="flex-1 flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900 p-6"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-16 w-16 text-gray-400 mb-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                        />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-100 mb-2">
                        Seleccione un usuario
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-center">
                        Elija un contacto para comenzar la conversación
                    </p>
                </div>

                <!-- Chat con usuario seleccionado -->
                <template v-else>
                    <!-- Cabecera del chat -->
                    <div
                        class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center bg-white dark:bg-gray-800"
                    >
                        <div class="w-10 h-10 bg-blue-200 dark:bg-blue-700 rounded-full"></div>
                        <div class="ml-3">
                            <div class="font-bold text-gray-800 dark:text-gray-100">
                                {{ selectedUser.name }}
                            </div>
                        </div>
                    </div>

                    <!-- Mensajes -->
                    <div
                        class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-gray-900"
                    >
                        <div
                            v-for="(message, index) in currentMessages"
                            :key="index"
                            class="flex"
                            :class="{
                                'justify-end': message.sender_id === auth.user.id,
                                'justify-start': message.recipient_id === auth.user.id,
                            }"
                        >
                            <div
                                class="px-4 py-2 rounded-lg max-w-[80%] md:max-w-md"
                                :class="message.recipient_id === auth.user.id
                                    ? 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100'
                                    : 'bg-blue-500 text-white'"
                            >
                                {{ message.message }}
                            </div>
                        </div>
                        <span ref="targetScrollRef"></span>
                    </div>

                    <!-- Área de escritura -->
                    <div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        <div
                            class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-2"
                        >
                            <input
                                type="text"
                                v-model="messageInput"
                                @keyup.enter="sendMessage"
                                placeholder="Escribe un mensaje..."
                                class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                            <button
                                @click="sendMessage"
                                class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors duration-200 flex items-center justify-center"
                                :disabled="!messageInput.trim()"
                                :class="{
                                    'opacity-50 cursor-not-allowed': !messageInput.trim(),
                                }"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref, onMounted, watch, nextTick } from "vue";
import axios from "axios";

// Componentes
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({ auth: Object, users: Array });
const selectedUser = ref(null);
const currentMessages = ref([]);
const messageInput = ref("");
const targetScrollRef = ref(null);
const webSocketChannel = `message.${props.auth.user.id}`;

const scrollToBottom = () => {
    nextTick(() => {
        if (targetScrollRef.value) {
            targetScrollRef.value.scrollIntoView({ behavior: "smooth" });
        }
    });
};

const getMessages = async () => {
    if (selectedUser.value) {
        const response = await axios.get(`/message/${selectedUser.value.id}`);
        currentMessages.value = response.data;
    }
};

const sendMessage = async () => {
    if (!messageInput.value.trim()) return;
    await axios.post(`/message/${selectedUser.value.id}`, {
        message: messageInput.value,
    });
    messageInput.value = "";
    getMessages();
};

const selectUser = (user) => {
    selectedUser.value = user;
};

watch(selectedUser, () => {
    if (selectedUser.value) {
        getMessages();
    }
});

watch(currentMessages, () => {
    scrollToBottom();
});

onMounted(() => {
    window.Echo.private(webSocketChannel).listen("MessageSent", async () => {
        await getMessages();
    });

    return () => {
        window.Echo.leave(webSocketChannel);
    };
});
</script>
