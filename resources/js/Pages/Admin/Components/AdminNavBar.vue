<template>
    <div>
        <ul class="flex space-x-6">
            <li>
                <a :href="route('admin.index')" class="hover:underline"
                    >Inicio</a
                >
            </li>

            <!-- 
                    <li>
                        <a :href="route('noticias')" class="hover:underline"
                            >Noticias</a
                        >
                    </li>
                    <li>
                        <a :href="route('eventos')" class="hover:underline"
                            >Eventos</a
                        >
                    </li> -->

            <li>
                <a
                    :href="route('admin.informationAdmin')"
                    class="hover:underline notification"
                    ><span>Solicitudes información</span>
                    <span class="badge">{{ numNotifs ? numNotifs : 0 }}</span>
                </a>
            </li>

            <li>
                <a :href="route('admin.messageAdmin')" class="hover:underline mr-10 ml-10"
                    >Mensajes trainers</a
                >
            </li>
            <li>
                <button @click="logout">Cerrar sesión</button>
            </li>
        </ul>
    </div>
</template>

<script setup>
// Importaciones
import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

// Variables
const props = defineProps(["notifications"]);

const numNotifs = ref(parseInt(props.notifications));

// console.log(numNotifs.value);

// Función para cerrar sesión
const logout = () => {
    router.post(route("logout"));
};

// Observar cambios en props.notifications y sincronizarlos
watch(
    () => props.notifications,
    (newNotifications) => {
        numNotifs.value = parseInt(newNotifications);
    }
);
</script>

<style scoped>
.notification {
    text-decoration: none;
    /* padding: 15px 26px; */
    position: relative;
    display: inline-block;
    border-radius: 2px;
}
/* 
.notification:hover {
    background: red;
} */

.notification .badge {
    position: absolute;
    top: -10px;
    right: -30px;
    padding: 5px 10px;
    border-radius: 50%;
    background: red;
    color: white;
}
</style>
