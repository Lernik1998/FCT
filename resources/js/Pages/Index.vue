<template>
    <head>
        <Head :title="'Inicio'" />
        <meta
            name="description"
            content="FitWorking - Encuentra actividades, conecta con entrenadores y únete a la comunidad de FitWorking"
        />
        <link rel="icon" href="/iconFW.ico" type="image/x-icon" />

        <meta
            name="keywords"
            content="FitWorking, actividades, entrenadores, comunidad"
        />
        <meta name="author" content="FitWorking" />
        <meta name="robots" content="index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="theme-color" content="#ffffff" />
        <meta
            name="og:title"
            content="FitWorking - Encuentra actividades, conecta con entrenadores y únete a la comunidad de FitWorking"
        />
        <meta
            name="og:description"
            content="FitWorking - Encuentra actividades, conecta con entrenadores y únete a la comunidad de FitWorking"
        />
        <meta name="og:type" content="website" />
        <meta name="og:url" content="https://fitworking.com" />
        <meta
            name="og:image"
            content="https://fitworking.com/images/og-image.jpg"
        />

        <!-- Canonical URL -->
        <link rel="canonical" href="https://fitworking.es" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />
    </head>

    <!-- Banner Principal -->
    <!-- <section class="text-center py-16 bg-gray-100">
                    <h1 class="text-4xl font-bold mb-4"></h1>
                    <p class="text-lg mb-6">
                        Encuentra actividades, conecta con entrenadores y únete
                        a la comunidad de FitWorking
                    </p>
                    <div class="space-x-4">
                        <button
                            class="px-6 py-2 bg-black text-white rounded-lg"
                            @click="login"
                        >
                            Empezar
                        </button>
                        <button
                            class="px-6 py-2 border border-gray-800 rounded-lg"
                            @click="exploreActivities"
                        >
                            Explorar actividades
                        </button>
                    </div>
                     <WeatherApi /> 
                </section> -->

    <section
        class="relative flex items-center justify-center overflow-hidden dark:bg-gray-900 dark:text-white"
        style="height: 75vh; min-height: 600px"
    >
        <!-- Video de fondo -->
        <div class="absolute inset-0 z-0">
            <video
                autoplay
                loop
                muted
                playsinline
                :poster="videoPoster"
                class="w-full h-full object-cover opacity-90"
            >
                <source :src="videoSrc" type="video/mp4" />
                Tu navegador no soporta videos HTML5.
            </video>
            <!-- Capa oscura para mejor contraste -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Contenido sobre el video -->
        <div class="relative z-10 text-center max-w-4xl px-4 py-20">
            <h1
                class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6 leading-tight"
            >
                MEJORA TU VIDA<br />
                <span class="text-orange-500">DENTRO Y FUERA DEL GIMNASIO</span>
            </h1>

            <p class="text-lg text-gray-200 mb-8 max-w-2xl mx-auto">
                Combinamos entrenamientos funcionales, eventos deportivos y un
                estilo de vida activo en un espacio diseñado para motivarte.
                Únete a nuestra comunidad y alcanza tu mejor versión.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button
                    class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors duration-300"
                    @click="login"
                >
                    Empieza ya
                </button>

                <button
                    class="px-6 py-3 border-2 border-white hover:border-orange-500 text-white hover:text-orange-500 font-medium rounded-lg transition-colors duration-300"
                    @click="exploreActivities"
                >
                    Explorar actividades
                </button>
            </div>
        </div>
    </section>

    <!-- Actividades Populares -->
    <!-- <section class="py-12 px-4">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Actividades Populares - - Algoritmo para filtrar las 3
                    actividades más contratadas.
                </h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <ActivityCard
                        title="Grupos de Running"
                        description="Únete a comunidades de corredores para todos los niveles."
                    />
                    <ActivityCard
                        title="Clases de Natación"
                        description="Instrucción profesional de natación para todas las edades."
                    />
                    <ActivityCard
                        title="Rutas en Bicicleta"
                        description="Explora Marina Alta sobre dos ruedas."
                    />
                </div>
            </div>
        </section> -->

    <!-- FitWorking es para ti -->
    <section
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 dark:bg-gray-900 dark:text-white"
    >
        <!-- Encabezado -->
        <div class="flex justify-between items-center mb-12">
            <h2
                class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white"
            >
                FitWorking es para ti
            </h2>
            <a
                :href="route('posts.index')"
                class="flex items-center text-orange-500 hover:text-orange-600 font-medium transition-colors"
            >
                Ver todos los posts
                <svg
                    class="w-5 h-5 ml-2"
                    viewBox="0 0 17 12"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12.749 6.451H0v-1.7h12.749L9.2 1.202 10.402 0l5.601 5.601-5.6 5.601L9.2 10l3.549-3.549Z"
                    />
                </svg>
            </a>
        </div>

        <!-- Grid de artículos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Artículo 1 -->
            <article
                class="group rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow"
            >
                <div class="relative h-56 overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1616803689943-5601631c7fec?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="A Father's Promise: Losing 84 Pounds To Run With His Kids"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                    ></div>
                </div>
                <div class="p-6">
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 dark:text-white"
                    >
                        Una promesa de padre: perder 38 kilos para correr con
                        sus hijos
                    </h3>
                    <p class="text-gray-600 mb-4 dark:text-gray-300">
                        Ahora es mucho más fácil caminar, subir escaleras y
                        correr detrás de los niños.
                    </p>
                </div>
            </article>

            <!-- Artículo 2 -->
            <article
                class="group rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow"
            >
                <div class="relative h-56 overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1616279969856-759f316a5ac1?q=80&w=1965&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Go Beyond The Physical: Developing Grit & Mental Strength with CrossFit"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                    ></div>
                </div>
                <div class="p-6">
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 dark:text-white"
                    >
                        Supera lo físico desarrollando tu resistencia y
                        fortaleza mental
                    </h3>
                    <p class="text-gray-600 mb-4 dark:text-gray-300">
                        Practicar un ejercicio físico que sea difícil ayuda a
                        desarrollar la fortaleza mental cuando algo no sale bien
                        en la vida.
                    </p>
                </div>
            </article>

            <!-- Artículo 3 -->
            <article
                class="group rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow"
            >
                <div class="relative h-56 overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1550657636-67d6a3a05a5d?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Annie at Auburn CrossFit"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                    ></div>
                </div>
                <div class="p-6">
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 dark:text-white"
                    >
                        Sentido de pertenencia: Una comunidad que camina contigo
                        hacia el cambio
                    </h3>
                    <p class="text-gray-600 mb-4 dark:text-gray-300">
                        Cuando compartimos el esfuerzo, el camino se hace más
                        llevadero. Aquí, cada logro es celebrado y cada
                        tropiezo, sostenido por otros. No estás solo: somos una
                        comunidad que avanza unida.
                    </p>
                </div>
            </article>
        </div>
    </section>

    <!-- Entrenadores Destacados -->
    <!-- <section class="py-12 px-4 bg-gray-100">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Entrenadores Destacados Hacer un sort() con los 3
                    entrenadores mas contratados.
                </h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8"
                >
                    <TrainerCard
                        name="Alex Martinez"
                        role="Entrenador Personal"
                    />
                    <TrainerCard
                        name="Sara Wilson"
                        role="Instructora de Yoga"
                    />
                    <TrainerCard
                        name="Mark Johnson"
                        role="Entrenador de Natación"
                    />
                    <TrainerCard name="Lisa Chen" role="Experta en Fitness" />
                </div>
            </div>
        </section> -->

    <!-- <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">
                    NUESTROS ENTRENADORES
                </h2>

                <!-- Contenedor del scroll infinito 
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 overflow-y-auto"
                    style="max-height: 800px"
                >
                    <!-- Tarjeta de entrenador (se repite dinámicamente)
                    <div
                        v-for="(trainer, index) in trainers"
                        :key="index"
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300"
                    >
                        <div class="relative h-64 overflow-hidden">
                            <img
                                :src="trainer.image"
                                :alt="trainer.name"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                loading="lazy"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                            ></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ trainer.name }}
                            </h3>
                            <p class="text-orange-500 font-medium mb-2">
                                {{ trainer.specialty }}
                            </p>
                            <p class="text-gray-600 text-sm">
                                {{ trainer.bio }}
                            </p>
                            <div class="mt-4 flex space-x-2">
                                <span
                                    v-for="(cert, i) in trainer.certifications"
                                    :key="i"
                                    class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded"
                                >
                                    {{ cert }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-12">
                        <a :href="route('trainers.index')" class="flex items-center">
                            Ver todos los entrenadores
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 ml-2"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section> -->

    <!-- Funcionamiento -->
    <section>
        <div
            class="bg-white py-16 px-4 sm:px-6 lg:px-8 dark:bg-gray-900 dark:text-white"
        >
            <div class="max-w-7xl mx-auto">
                <!-- Título de sección (opcional) -->
                <h2
                    class="text-3xl font-bold text-center text-gray-900 mb-12 dark:text-white"
                >
                    ¿Cómo funcionamos?
                </h2>

                <h4 class="mb-10 text-center dark:text-white">
                    Si tienes dudas de cómo trabajamos aquí y qué
                    características tiene nuestro servicio, te cuento brevemente
                    abajo.
                </h4>

                <!-- Grid de beneficios -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8"
                >
                    <BenefitCard
                        v-for="(benefit, index) in benefits"
                        :key="index"
                        :icon="benefit.icon"
                        :title="benefit.title"
                        :description="benefit.description"
                    />
                </div>
            </div>
        </div>
    </section>

    <!-- Negocios Destacados -->
    <!-- <section class="py-12 px-4">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">Negocios Destacados o Patrocinadores</h2>
                <h4 class="mb-10">
                    Mostrar con más frecuencia aquellas que hayan pagado el
                    paquete de promoción más caro.
                </h4>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <BusinessCard
                        name="FitZone Gym"
                        description="Equipamiento de última generación y entrenadores expertos."
                    />
                    <BusinessCard
                        name="Marina Sports Club"
                        description="Instalaciones profesionales de deportes acuáticos y alquiler de equipos."
                    />

                    <BusinessCard
                        name="FitZone Gym"
                        description="Equipamiento de última generación y entrenadores expertos."
                    />
                </div>
            </div>
        </section> -->
</template>

<script setup>
// Importaciones
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import BenefitCard from "./Public/Components/BenefitCard.vue";

// Componentes
// import WeatherApi from "@/Components/WeatherApi.vue";
// import ActivityCard from "@/Components/ActivityCard.vue";
// import TrainerCard from "@/Components/TrainerCard.vue";
// import BusinessCard from "@/Components/BusinessCard.vue";

const videoSrc = ref(
    "https://www.crossfit.com/wp-content/uploads/2023/11/13114552/CrossFit-Where-Fitness-Meets-Health.mp4"
);
const videoPoster = ref(
    "https://www.crossfit.com/wp-content/uploads/2023/11/13131232/crossfit-coach-led-fitness-training-adapted-for-you-handstand-hold.jpg"
);

const login = () => {
    router.visit(route("login"));
};
const exploreActivities = () => {
    router.visit(route("activities.index"));
};

// Pueden venir de props o API
const benefits = [
    {
        icon: "M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z",
        title: "Entrevista Inicial",
        description:
            "Te escucharemos y adaptaremos este estilo de vida saludable a tu situación actual para asegurarnos el éxito.",
    },
    {
        icon: "M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25",
        title: "Alimentación Intuitiva",
        description:
            "Te daremos unas pautas con las que aprenderás a comer sano y fácil. No más dietas insostenibles y aburridas.",
    },
    {
        icon: "M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602",
        title: "Entrenamiento Consciente",
        description:
            "Mejorarás de la forma más eficiente posible. Sin poner en riesgo tu salud, tu tiempo y tu dinero.",
    },
    {
        icon: "M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z",
        title: "Desarrollo Personal",
        description:
            "Aquí no solo conseguirás mejorar tu cuerpo y tu salud, además, te conocerás mejor y mejorarás tu mentalidad.",
    },
    {
        icon: "M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z",
        title: "Buen Rollo",
        description:
            "Puede que empieces aquí para conseguir tus objetivos, pero te aseguro que te quedarás por el buen ambiente que te encontrarás en las clases.",
    },
    {
        icon: "M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l1.15-.963m7.095-9.642L15.45 4.63m0 0a6.003 6.003 0 00-4.5 10.698",
        title: "Compromiso",
        description:
            "Seamos honestos, se te hace cuesta arriba hacerlo por tu cuenta. ¡Nosotros seremos ese empujón que te hace falta para arrancar!",
    },
    {
        icon: "M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z",
        title: "Flexibilidad Horaria",
        description:
            "Encontraremos el mejor horario para ti, para que no sea un rompecabezas venir a entrenar.",
    },
    {
        icon: "M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z",
        title: "Actividades Grupales",
        description:
            "Los fines de semana organizamos actividades al aire libre y quedadas para disfrutar de estar físicamente activos y compartir aprendizajes.",
    },
];
</script>

<style scoped>
button {
    transition: all 0.3s;
}
button:hover {
    opacity: 0.8;
}

/* Efectos adicionales */
article {
    transition: all 0.3s ease;
}

article:hover {
    transform: translateY(-5px);
}
</style>
