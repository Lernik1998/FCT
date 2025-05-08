<template>
    <pre>{{ reservations }}</pre>

    <pre>{{ totalHours }}</pre>

    <pre>{{ totalActivities }}</pre>

    <!-- Contenido principal -->
    <main class="min-h-screen bg-gradient-to-b py-8 px-4 sm:px-6">
        <h1 class="text-xl font-bold">Mi Progreso</h1>
        <div class="max-w-6xl mx-auto">
            <!-- Encabezado -->
            <div class="text-center mb-10 animate-fade-in">
                <h1
                    class="text-3xl sm:text-4xl font-bold text-gray-800 flex items-center justify-center"
                >
                    Evolución deportiva
                </h1>
                <p class="text-lg text-gray-600 mt-3 max-w-2xl mx-auto">
                    Visualiza tus logros y supera tus propias metas
                </p>
            </div>

            <!-- Grid de contenido -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Tarjeta de resumen -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-in">
                    <h2
                        class="text-xl font-bold text-gray-800 mb-4 flex items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 mr-2 text-orange-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                            />
                        </svg>
                        Resumen Mensual
                    </h2>

                    <div class="flex justify-between items-center mb-6">
                        <div class="text-center">
                            <p class="text-4xl font-bold text-orange-500">
                                {{ currentMonthHours }}
                            </p>
                            <p class="text-gray-500">Horas este mes</p>
                        </div>
                        <!-- <div class="text-center">
                            <p class="text-4xl font-bold text-blue-500">
                                {{ progressPercentage }}%
                            </p>
                            <p class="text-gray-500">Progreso</p>
                        </div> -->
                        <!-- <div class="text-center">
                            <p class="text-4xl font-bold text-green-500">
                                {{ currentStreak }}
                            </p>
                            <p class="text-gray-500">Días seguidos</p>
                        </div> -->
                    </div>

                    <div class="bg-gray-100 rounded-lg p-4">
                        <h3 class="font-medium text-gray-700 mb-2">
                            Tu objetivo: {{ monthlyGoal }} horas
                        </h3>
                        <div class="w-full bg-gray-300 rounded-full h-4">
                            <div
                                class="bg-orange-500 h-4 rounded-full"
                                :style="`width: ${progressPercentage}%`"
                            />
                        </div>
                        <p class="text-right text-sm text-gray-500 mt-1">
                            {{ currentMonthHours }} de {{ monthlyGoal }} horas
                        </p>
                    </div>
                </div>

                <!-- Gráfica de progreso -->
                <!-- <div
                    class="bg-white rounded-xl shadow-lg p-6 animate-slide-in lg:col-span-2"
                >
                    <div class="flex justify-between items-center mb-6">
                        <h2
                            class="text-xl font-bold text-gray-800 flex items-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 mr-2 text-orange-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                />
                            </svg>
                            Progreso Anual
                        </h2>
                        <select
                            v-model="selectedYear"
                            class="bg-white border border-gray-300 rounded-full px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                            <option
                                v-for="year in availableYears"
                                :key="year"
                                :value="year"
                            >
                                {{ year }}
                            </option>
                        </select>
                    </div>

                    <div class="h-64"> -->
                <!-- Aquí iría el componente de gráfica real -->
                <!-- <div
                            class="w-full h-full bg-gray-100 rounded-lg flex items-center justify-center text-gray-400"
                        >
                            [Gráfica de progreso anual]
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-4 gap-4 text-center">
                        <div
                            v-for="(stat, index) in quickStats"
                            :key="index"
                            class="bg-gray-50 p-2 rounded-lg"
                        >
                            <p class="text-sm text-gray-500">
                                {{ stat.label }}
                            </p>
                            <p class="font-bold" :class="stat.color">
                                {{ stat.value }}
                            </p>
                        </div>
                    </div>
                </div> -->

                <!-- Ranking de amigos -->
                <!-- <div
                    class="bg-white rounded-xl shadow-lg p-6 animate-slide-in lg:col-span-2"
                >
                    <h2
                        class="text-xl font-bold text-gray-800 mb-4 flex items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 mr-2 text-orange-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                        Ranking de Amigos
                    </h2>

                    <div class="flex items-center mb-4">
                        <input
                            type="text"
                            placeholder="Buscar amigos..."
                            class="flex-grow border border-gray-300 rounded-l-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        />
                        <button
                            class="bg-orange-500 text-white px-4 py-2 rounded-r-full hover:bg-orange-600 transition-colors"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
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
                        </button>
                    </div>

                    <div class="space-y-3">
                        <div
                            v-for="(friend, index) in friendsRanking"
                            :key="friend.id"
                            class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors"
                        >
                            <div class="relative">
                                <span
                                    class="absolute -left-2 -top-2 bg-orange-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center"
                                >
                                    {{ index + 1 }}
                                </span>
                                <img
                                    :src="friend.avatar"
                                    :alt="friend.name"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-orange-200"
                                />
                            </div>
                            <div class="ml-4 flex-grow">
                                <h3 class="font-bold text-gray-800">
                                    {{ friend.name }}
                                </h3>
                                <div class="flex items-center">
                                    <div
                                        class="w-full bg-gray-200 rounded-full h-2 mr-2"
                                    >
                                        <div
                                            class="bg-orange-500 h-2 rounded-full"
                                            :style="`width: ${
                                                (friend.points / maxPoints) *
                                                100
                                            }%`"
                                        ></div>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-orange-600"
                                        >{{ friend.points }} pts</span
                                    >
                                </div>
                            </div>
                            <button
                                class="ml-2 p-2 text-gray-400 hover:text-orange-500 rounded-full hover:bg-orange-50 transition-colors"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button
                        class="mt-4 w-full border-2 border-orange-500 text-orange-500 font-medium py-2 rounded-lg hover:bg-orange-50 transition-colors flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8H4"
                            />
                        </svg>
                        Invitar más amigos
                    </button>
                </div> -->

                <!-- Logros -->
                <!-- <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-in">
                    <h2
                        class="text-xl font-bold text-gray-800 mb-4 flex items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 mr-2 text-orange-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                            />
                        </svg>
                        Tus Logros
                    </h2>

                    <p class="text-gray-600 mb-4">
                        Has desbloqueado {{ unlockedAchievements.length }} de
                        {{ totalAchievements }} logros
                    </p>

                    <div class="grid grid-cols-3 gap-3">
                        <div
                            v-for="achievement in achievementsDisplay"
                            :key="achievement.id"
                            class="text-center"
                        >
                            <div class="relative mx-auto w-16 h-16 mb-2">
                                <div
                                    class="w-full h-full rounded-full flex items-center justify-center"
                                    :class="
                                        achievement.unlocked
                                            ? 'bg-orange-100'
                                            : 'bg-gray-100'
                                    "
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8"
                                        :class="
                                            achievement.unlocked
                                                ? 'text-orange-500'
                                                : 'text-gray-400'
                                        "
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                        />
                                    </svg>
                                </div>
                                <div
                                    v-if="achievement.unlocked"
                                    class="absolute -bottom-1 -right-1 bg-orange-500 rounded-full w-5 h-5 flex items-center justify-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3 text-white"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <p
                                class="text-xs font-medium"
                                :class="
                                    achievement.unlocked
                                        ? 'text-gray-800'
                                        : 'text-gray-400'
                                "
                            >
                                {{ achievement.name }}
                            </p>
                        </div>
                    </div>

                    <button
                        class="mt-4 w-full bg-orange-500 text-white font-medium py-2 rounded-lg hover:bg-orange-600 transition-colors"
                    >
                        Ver todos los logros
                    </button>
                </div>-->
            </div>
        </div>
    </main>
</template>

<script setup>
// Importaciones de componentes
import { ref, computed, onMounted } from "vue";
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

// Props
// Props - asignar el resultado de defineProps a una variable
const props = defineProps({
    reservations: Array,
    totalHours: Number,
    totalActivities: Number,
    user: Object,
});

// Datos de progreso
const currentMonthHours = ref(0);
const monthlyGoal = ref(20);
const currentStreak = ref(0);

// Logros
// const totalAchievements = 12;
// const unlockedAchievements = ref([1, 2, 3, 4, 5, 8]);
// const allAchievements = ref([
//     { id: 1, name: "Principiante", unlocked: true },
//     { id: 2, name: "5 días", unlocked: true },
//     { id: 3, name: "10 horas", unlocked: true },
//     { id: 4, name: "Maratón", unlocked: true },
//     { id: 5, name: "Rutina", unlocked: true },
//     { id: 6, name: "50 horas", unlocked: false },
//     { id: 7, name: "Reto 30d", unlocked: false },
//     { id: 8, name: "Social", unlocked: true },
//     { id: 9, name: "Élite", unlocked: false },
//     { id: 10, name: "100h", unlocked: false },
//     { id: 11, name: "Maestro", unlocked: false },
//     { id: 12, name: "Leyenda", unlocked: false },
// ]);

// Mostrar solo 6 logros (3x2 grid)
const achievementsDisplay = computed(() => {
    return allAchievements.value.slice(0, 6);
});

// Calcular porcentaje de progreso
// const progressPercentage = computed(() => {
//     return Math.min(
//         Math.round((currentMonthHours.value / monthlyGoal.value) * 100),
//         100
//     );
// });

const progressPercentage = computed(() => {
    if (monthlyGoal.value === 0) return 0;
    return Math.min(
        (currentMonthHours.value / monthlyGoal.value) * 100,
        100
    ).toFixed(2);
});

onMounted(() => {
    currentMonthHours.value = props.totalHours || 0;

    // monthlyGoal.value = props.user?.monthly_goal || 20; // Valor por defecto si no existe
});
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

.transition-colors {
    transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
