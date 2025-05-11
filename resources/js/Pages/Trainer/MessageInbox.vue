<template>
    <!-- Contenedor principal con dark mode -->
    <div class="flex h-[90vh] bg-gray-100 dark:bg-gray-900">
        <!-- Panel lateral - responsive -->
        <div class="w-full md:w-1/3 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col" :class="{ 'hidden md:flex': selectedUser }">
            <!-- Filtros y búsqueda -->
            <div class="p-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                <div class="flex space-x-2 mb-2 overflow-x-auto pb-2">
                    <button
                        v-for="filter in filters"
                        :key="filter.value"
                        @click="activeFilter = filter.value"
                        class="px-3 py-1 text-sm rounded-full whitespace-nowrap"
                        :class="
                            activeFilter === filter.value
                                ? 'bg-blue-500 text-white'
                                : 'bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-500'
                        "
                    >
                        {{ filter.label }}
                    </button>
                </div>
                <div class="relative">
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Buscar contactos..."
                        class="w-full py-2 pl-10 pr-4 bg-white dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent dark:text-white dark:placeholder-gray-300"
                    />
                    <svg
                        class="absolute left-3 top-2.5 h-4 w-4 text-gray-500 dark:text-gray-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </div>
            </div>

            <!-- Gestión de contactos -->
            <div
                class="p-3 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-white dark:bg-gray-800"
            >
                <h3 class="font-medium dark:text-white">Mis contactos</h3>
                <button
                    @click="showContactForm = true"
                    class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 p-1 rounded-full hover:bg-green-50 dark:hover:bg-gray-700"
                    title="Añadir contacto"
                >
                    <svg
                        class="h-5 w-5"
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
                </button>
            </div>

            <!-- Lista de contactos -->
            <div class="flex-1 overflow-y-auto">
                <div
                    v-for="user in filteredUsers"
                    :key="user.id"
                    @click="selectUser(user)"
                    class="flex items-center p-3 border-b border-gray-100 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700"
                    :class="{ 'bg-green-50 dark:bg-green-900': user.id === selectedUser?.id }"
                >
                    <div class="relative">
                        <div
                            class="w-10 h-10 bg-gray-300 dark:bg-gray-600 rounded-full overflow-hidden"
                        >
                            <!-- <img
                                :src="user.avatar || '/default-avatar.png'"
                                class="w-full h-full object-cover"
                            /> -->
                        </div>
                        <span
                            v-if="user.online"
                            class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"
                        ></span>
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <div class="flex justify-between">
                            <p class="font-medium text-gray-900 dark:text-white truncate">
                                {{ user.name }}
                            </p>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{
                                formatLastMessageTime(user.lastMessage)
                            }}</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                            {{ user.lastMessage?.message || "Nuevo contacto" }}
                        </p>
                    </div>
                    <span
                        v-if="user.unread"
                        class="ml-2 bg-green-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"
                    >
                        {{ user.unread }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Área de chat -->
        <div class="flex-1 flex flex-col bg-gray-50 dark:bg-gray-900">
            <div
                v-if="!selectedUser"
                class="flex-1 flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-800 p-6"
            >
                <div
                    class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-full mb-4 flex items-center justify-center text-gray-400 dark:text-gray-500"
                >
                    <svg
                        class="h-12 w-12"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                        />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-2">
                    Selecciona un contacto
                </h3>
                <p class="text-gray-500 dark:text-gray-400 text-center max-w-md">
                    Elige un contacto de la lista para comenzar una conversación
                    o añade nuevos contactos.
                </p>
            </div>

            <!-- Chat con usuario seleccionado -->
            <template v-else>
                <!-- Encabezado del chat -->
                <div
                    class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center"
                >
                    <div class="flex items-center">
                        <button
                            @click="selectedUser = null"
                            class="md:hidden mr-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        </button>
                        <div class="relative">
                            <div
                                class="w-10 h-10 bg-gray-300 dark:bg-gray-600 rounded-full overflow-hidden"
                            >
                                <img
                                    :src="
                                        selectedUser.avatar ||
                                        '/default-avatar.png'
                                    "
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <span
                                v-if="selectedUser.online"
                                class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"
                            ></span>
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold dark:text-white">{{ selectedUser.name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{
                                    selectedUser.online
                                        ? "En línea"
                                        : "Últ. vez " +
                                          formatLastSeen(selectedUser.lastSeen)
                                }}
                            </p>
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <button
                            class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                            title="Llamar"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                />
                            </svg>
                        </button>
                        <button
                            @click="openUserSettings(selectedUser)"
                            class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                            title="Editar contacto"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mensajes -->
                <div
                    class="flex-1 overflow-y-auto p-4 bg-[#e5ddd5] dark:bg-gray-700 bg-opacity-30 bg-[url('/whatsapp-bg.png')] dark:bg-opacity-50"
                    style="background-size: contain"
                >
                    <div
                        v-for="(message, index) in currentMessages"
                        :key="index"
                        class="mb-3"
                    >
                        <div
                            class="flex"
                            :class="{
                                'justify-end':
                                    message.sender_id === auth.user.id,
                                'justify-start':
                                    message.recipient_id === auth.user.id,
                            }"
                        >
                            <div
                                class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg"
                                :class="{
                                    'bg-white dark:bg-gray-600 rounded-tr-none':
                                        message.recipient_id === auth.user.id,
                                    'bg-green-100 dark:bg-green-800 rounded-tl-none':
                                        message.sender_id === auth.user.id,
                                }"
                            >
                                <p class="text-sm dark:text-white">{{ message.message }}</p>
                                <div
                                    class="text-right mt-1 text-xs text-gray-500 dark:text-gray-400"
                                >
                                    {{ formatMessageTime(message.created_at) }}
                                    <span
                                        v-if="
                                            message.sender_id === auth.user.id
                                        "
                                        class="ml-1"
                                    >
                                        <svg
                                            v-if="message.read"
                                            class="h-3 w-3 inline text-green-500"
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
                                        <svg
                                            v-else
                                            class="h-3 w-3 inline text-gray-400"
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
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div ref="messagesEnd"></div>
                </div>

                <!-- Input de mensaje -->
                <div class="p-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <button class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </button>
                        <button class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                                />
                            </svg>
                        </button>
                        <input
                            v-model="messageInput"
                            @keyup.enter="sendMessage"
                            type="text"
                            placeholder="Escribe un mensaje..."
                            class="flex-1 py-2 px-4 mx-2 bg-white dark:bg-gray-700 rounded-full border-none focus:outline-none focus:ring-1 focus:ring-green-500 dark:text-white dark:placeholder-gray-300"
                        />
                        <button
                            @click="sendMessage"
                            class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                            :class="{ 'text-green-600 dark:text-green-400': messageInput.trim() }"
                        >
                            <svg
                                v-if="messageInput.trim()"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                />
                            </svg>
                            <svg
                                v-else
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Modal para añadir/editar contacto -->
    <div
        v-if="showContactForm"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    >
        <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-md">
            <div
                class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center"
            >
                <h3 class="text-lg font-semibold dark:text-white">
                    {{ editingContact ? "Editar Contacto" : "Nuevo Contacto" }}
                </h3>
                <button
                    @click="closeContactForm"
                    class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                >
                    <svg
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

            <div class="p-4">
                <div class="space-y-4">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >Nombre completo</label
                        >
                        <input
                            v-model="contactForm.name"
                            type="text"
                            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Ej: Juan Pérez"
                        />
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >Número de teléfono</label
                        >
                        <input
                            v-model="contactForm.phone"
                            type="tel"
                            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Ej: +34611223344"
                        />
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"
                            >Tipo de contacto</label
                        >
                        <select
                            v-model="contactForm.type"
                            class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="client">Cliente</option>
                            <option value="colleague">Colega</option>
                            <option value="provider">Proveedor</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button
                        @click="closeContactForm"
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700"
                    >
                        Cancelar
                    </button>
                    <button
                        @click="saveContact"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
                    >
                        {{
                            editingContact
                                ? "Guardar cambios"
                                : "Añadir contacto"
                        }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>



<script setup>
import { ref, computed, onMounted, nextTick } from "vue";
import TrainerLayout from "@/Layouts/TrainerLayout.vue";

defineOptions({
    layout: TrainerLayout,
});

const props = defineProps({
    auth: Object,
    users: Array,
    initialContacts: Array,
});

// Datos del chat
const selectedUser = ref(null);
const currentMessages = ref([]);
const messageInput = ref("");
const messagesEnd = ref(null);
const searchQuery = ref("");
const activeFilter = ref("all");

// Filtros disponibles
const filters = ref([
    { value: "all", label: "Todos" },
    { value: "clients", label: "Clientes" },
    { value: "recent", label: "Recientes" },
    { value: "unread", label: "No leídos" },
]);

// Gestión de contactos
const showContactForm = ref(false);
const editingContact = ref(false);
const contactForm = ref({
    id: null,
    name: "",
    phone: "",
    type: "client",
});

// Filtrar usuarios basado en búsqueda y filtros
const filteredUsers = computed(() => {
    let result = props.users;

    // Aplicar filtro activo
    if (activeFilter.value === "clients") {
        result = result.filter((u) => u.type === "client");
    } else if (activeFilter.value === "recent") {
        result = result.sort(
            (a, b) =>
                new Date(b.lastMessage?.created_at) -
                new Date(a.lastMessage?.created_at)
        );
    } else if (activeFilter.value === "unread") {
        result = result.filter((u) => u.unread > 0);
    }

    // Aplicar búsqueda
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        result = result.filter(
            (u) =>
                u.name.toLowerCase().includes(query) ||
                (u.phone && u.phone.includes(query))
        );
    }

    return result;
});

// Formatear fechas
const formatMessageTime = (dateString) => {
    if (!dateString) return "";
    const date = new Date(dateString);
    return date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
};

const formatLastMessageTime = (message) => {
    if (!message?.created_at) return "";
    const date = new Date(message.created_at);
    const now = new Date();

    if (date.toDateString() === now.toDateString()) {
        return date.toLocaleTimeString([], {
            hour: "2-digit",
            minute: "2-digit",
        });
    }
    return date.toLocaleDateString([], { day: "numeric", month: "short" });
};

const formatLastSeen = (dateString) => {
    if (!dateString) return "";
    const date = new Date(dateString);
    return date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
};

// Funciones del chat
const selectUser = (user) => {
    selectedUser.value = user;
    // Marcar mensajes como leídos
    if (user.unread) {
        user.unread = 0;
    }
    loadMessages(user.id);
};

const loadMessages = (userId) => {
    // Simular carga de mensajes
    currentMessages.value = [
        {
            id: 1,
            message: "Hola, ¿cómo estás?",
            sender_id: userId,
            recipient_id: props.auth.user.id,
            created_at: new Date(Date.now() - 3600000).toISOString(),
            read: true,
        }]
     
    scrollToBottom();
};

const sendMessage = () => {
    if (!messageInput.value.trim() || !selectedUser.value) return;

    const newMessage = {
        id: Date.now(),
        message: messageInput.value,
        sender_id: props.auth.user.id,
        recipient_id: selectedUser.value.id,
        created_at: new Date().toISOString(),
        read: false,
    };

    currentMessages.value.push(newMessage);
    messageInput.value = "";
    scrollToBottom();

    // Actualizar último mensaje en la lista
    const user = props.users.find((u) => u.id === selectedUser.value.id);
    if (user) {
        user.lastMessage = {
            message: newMessage.message,
            created_at: newMessage.created_at,
        };
    }
};

const scrollToBottom = () => {
    nextTick(() => {
        if (messagesEnd.value) {
            messagesEnd.value.scrollIntoView({ behavior: "smooth" });
        }
    });
};

// Funciones de gestión de contactos
const openUserSettings = (user) => {
    contactForm.value = {
        id: user.id,
        name: user.name,
        phone: user.phone,
        type: user.type || "client",
    };
    editingContact.value = true;
    showContactForm.value = true;
};

const saveContact = () => {
    if (!contactForm.value.name || !contactForm.value.phone) return;

    if (editingContact.value) {
        // Actualizar contacto existente
        const index = props.users.findIndex(
            (u) => u.id === contactForm.value.id
        );
        if (index !== -1) {
            props.users[index] = {
                ...props.users[index],
                ...contactForm.value,
            };
        }
    } else {
        // Añadir nuevo contacto
        const newContact = {
            id: Date.now(),
            ...contactForm.value,
            online: false,
            unread: 0,
            lastMessage: null,
        };
        props.users.unshift(newContact);
    }

    closeContactForm();
};

const closeContactForm = () => {
    showContactForm.value = false;
    editingContact.value = false;
    contactForm.value = {
        id: null,
        name: "",
        phone: "",
        type: "client",
    };
};

// Inicialización
onMounted(() => {
    // Simular datos de usuarios si no hay
    if (props.users.length === 0) {
        props.users.push(
            {
                id: 1,
                name: "Ana Martínez",
                phone: "+34611223344",
                type: "client",
                online: true,
                lastMessage: {
                    message: "Nos vemos mañana",
                    created_at: new Date(Date.now() - 3600000).toISOString(),
                },
                unread: 2,
            },
            {
                id: 2,
                name: "Carlos Ruiz",
                phone: "+34655667788",
                type: "client",
                online: false,
                lastSeen: new Date(Date.now() - 86400000).toISOString(),
                lastMessage: {
                    message: "Gracias por la sesión",
                    created_at: new Date(Date.now() - 86400000).toISOString(),
                },
                unread: 0,
            },
            {
                id: 3,
                name: "Laura Gómez",
                phone: "+34699887766",
                type: "colleague",
                online: true,
                lastMessage: {
                    message: "¿A qué hora es la clase?",
                    created_at: new Date(Date.now() - 1800000).toISOString(),
                },
                unread: 1,
            }
        );
    }
});
</script>
