<template>
    <!-- <Head title="Inbox" /> -->
    <!-- Barra navegación del Trainer -->
    <nav class="p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Marina Alta Sports</div>
            <TrainersNavBar />
        </div>
    </nav>

    <div class="h-screen flex bg-gray-400 border-b gap-2" style="height: 90vh">
        <!-- Sidebar -->
        <div class="w-1/4 border-r">
            <div
                class="p-6 bg-green-500 font-bold text-lg border-b border-t border-gray-200"
            >
                Usuarios
            </div>

            <div class="p-4 space-y-4">
                <!-- Cargar en un futuro solo a los usuarios que el Trainer tenga una cita programada.
                Los usuarios si tienen amigos agregados, que puedan hablar.
                El admin puede hablar con todos. -->
                <div
                    v-for="user in users"
                    :key="user.id"
                    @click="selectUser(user)"
                    class="flex items-center p-2 rounded cursor-pointer"
                    :class="{
                        'bg-yellow-500 text-white':
                            user.id === selectedUser?.id,
                    }"
                >
                    <div class="w-12 h-18 bg-blue-200 rounded-full"></div>
                    <div class="ml-4">
                        <div class="font-semibold">{{ user.name }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div
            class="flex flex-col w-3/4 border-l border-r border-b border-t border-gray-500"
        >
            <div
                v-if="!selectedUser"
                class="h-full flex justify-center items-center text-gray-800 font-bold"
            >
                <h4 class="text-2xl">Seleccione un usuario</h4>
            </div>
            <template v-else>
                <div class="p-4 border-b flex items-center">
                    <div class="w-12 h-18 bg-blue-200 rounded-full"></div>
                    <div class="ml-10">
                        <div class="font-bold">{{ selectedUser.name }}</div>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
                    <div
                        v-for="(message, index) in currentMessages"
                        :key="index"
                        class="flex"
                        :class="{
                            'justify-end': message.sender_id === auth.user.id,
                            'justify-start':
                                message.recipient_id === auth.user.id,
                        }"
                    >
                        <div
                            class="p-3 rounded-lg max-w-xs"
                            :class="
                                message.recipient_id === auth.user.id
                                    ? 'bg-gray-200 text-gray-800'
                                    : 'bg-blue-500 text-white'
                            "
                        >
                            {{ message.message }}
                        </div>
                    </div>
                    <span ref="targetScrollRef"></span>
                </div>

                <div class="p-4 bg-white border-t border-gray-200">
                    <div class="flex items-center">
                        <input
                            type="text"
                            v-model="messageInput"
                            placeholder="Escribe un mensaje..."
                            class="flex-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <button
                            @click="sendMessage"
                            class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                        >
                            Enviar
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, nextTick } from "vue";
import axios from "axios";
import { Head } from "@inertiajs/vue3";

// Componentes
import TrainersNavBar from "./Components/TrainersNavBar.vue";

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
