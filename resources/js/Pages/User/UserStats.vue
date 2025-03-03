<template>
    <!-- Barra de Navegación -->
    <nav class="bg-black p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <UsersNavBar />
        </div>
    </nav>

    <section class="min-h-screen bg-gray-100 py-12 px-6">
        <div class="max-w-5xl mx-auto">
            <!-- Título -->
            <h1
                class="text-3xl font-bold text-gray-800 text-center mb-6 animate-fade-in"
            >
                Control de Progreso
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Gráfica de progreso -->
                <div class="bg-white shadow-lg rounded-lg p-6 animate-slide-in">
                    <h2
                        class="text-2xl font-semibold text-gray-700 text-center mb-4"
                    >
                        Progreso Mensual
                    </h2>
                    <p class="text-center text-gray-500 mb-4">
                        Resumen de horas de ejercicio este mes
                    </p>

                    <div class="w-full h-64">
                        <!-- <BarChart
                            :data="progressData"
                            :keys="['horas']"
                            :index="'mes'"
                            class="h-full"
                        /> -->
                    </div>
                </div>

                <!-- Ranking de amigos -->
                <div class="bg-white shadow-lg rounded-lg p-6 animate-slide-in">
                    <h2
                        class="text-2xl font-semibold text-gray-700 text-center mb-4"
                    >
                        Ranking de Amigos
                    </h2>
                    <p class="text-center text-gray-500 mb-4">
                        Compite con tus amigos y mejora tu rendimiento
                    </p>

                    <ul class="divide-y divide-gray-200">
                        <li
                            v-for="(friend, index) in friendsRanking"
                            :key="friend.id"
                            class="py-3 flex items-center"
                        >
                            <span class="font-bold text-lg w-8 text-center">{{
                                index + 1
                            }}</span>
                            <img
                                :src="friend.avatar"
                                alt="Avatar"
                                class="w-10 h-10 rounded-full mr-4"
                            />
                            <div class="flex-grow">
                                <p class="text-gray-800 font-medium">
                                    {{ friend.name }}
                                </p>
                                <p class="text-gray-500 text-sm">
                                    Puntos: {{ friend.points }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Importaciones
import { ref } from "vue";
// import { BarChart } from "vue-chart-3";

// Componentes
import UsersNavBar from "./Components/UsersNavBar.vue";

// Datos de progreso mensual
const progressData = ref([
    { mes: "Enero", horas: 15 },
    { mes: "Febrero", horas: 18 },
    { mes: "Marzo", horas: 20 },
    { mes: "Abril", horas: 25 },
    { mes: "Mayo", horas: 30 },
    { mes: "Junio", horas: 28 },
]);

// Datos del ranking de amigos
const friendsRanking = ref([
    {
        id: 1,
        name: "Carlos",
        points: 1200,
        avatar: "https://source.unsplash.com/50x50/?person",
    },
    {
        id: 2,
        name: "Andrea",
        points: 1100,
        avatar: "https://source.unsplash.com/50x50/?girl",
    },
    {
        id: 3,
        name: "David",
        points: 1050,
        avatar: "https://source.unsplash.com/50x50/?man",
    },
    {
        id: 4,
        name: "Laura",
        points: 980,
        avatar: "https://source.unsplash.com/50x50/?woman",
    },
    {
        id: 5,
        name: "Pedro",
        points: 950,
        avatar: "https://source.unsplash.com/50x50/?boy",
    },
]);
</script>

<style scoped>
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

@keyframes slide-in {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-slide-in {
    animation: slide-in 0.6s ease-out;
}
</style>
