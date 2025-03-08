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
                <a href="#" class="hover:underline">Solicitudes información</a>
            </li>

            <li>
                <a href="#" class="hover:underline">Solicitudes entrenadores</a>
            </li>
            <li>
                <!-- Log out -->
                <a href="#" class="hover:underline">Cerrar sesión</a>
            </li>
        </ul>
    </div>

    <p>
        Molaria poder mostrar las notificaciones, aprobaciones que se tienen que
        aceptar... Mirarlo aquí:
        https://www.w3schools.com/howto/howto_css_notification_button.asp
    </p>
</template>

<script setup></script>
