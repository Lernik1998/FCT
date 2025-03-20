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
                    class="hover:underline"
                    >Solicitudes información</a
                >
            </li>

            <li>
                <a href="#" class="hover:underline"
                    >Solicitudes entrenadores o mejor directamente el chat</a
                >
            </li>
            <li>
                <button @click="logout">Cerrar sesión</button>
            </li>
        </ul>
    </div>

    <p>
        Molaria poder mostrar las notificaciones, aprobaciones que se tienen que
        aceptar... Mirarlo aquí:
        https://www.w3schools.com/howto/howto_css_notification_button.asp
    </p>
</template>

<script setup>
// Importaciones
import { router } from "@inertiajs/vue3";
// Función para cerrar sesión
const logout = () => {
    router.post(route("logout"));
};
</script>
