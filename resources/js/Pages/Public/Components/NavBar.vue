<template>
    <div>
        <ul class="flex space-x-6">
            <li>
                <a :href="route('index')" class="hover:underline">Inicio</a>
            </li>
            <li>
                <a :href="route('activities.index')" class="hover:underline"
                    >Actividades</a
                >
            </li>
            <li>
                <a :href="route('trainers.index')" class="hover:underline"
                    >Entrenadores</a
                >
            </li>
            <li>
                <a :href="route('posts.index')" class="hover:underline"
                    >Posts</a
                >
            </li>
            <!--    <li>
                        <a :href="route('eventos')" class="hover:underline"
                            >Eventos</a
                        >
                    </li> -->

            <li>
                <a :href="route('contact')" class="hover:underline">Contacto</a>
            </li>

            <li>
                <a :href="route('login')" class="hover:underline"
                    >Iniciar Sesion</a
                >
            </li>
        </ul>
    </div>
</template>
