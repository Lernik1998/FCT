<template>
    <main class="w-full min-h-screen mx-auto py-6 px-4 sm:px-6 lg:px-8 dark:bg-gray-900 transition-colors duration-300">
        <!-- Encabezado principal -->
        <div class="mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white">
                Mi Progreso
            </h1>
        </div>

        <div class="max-w-6xl mx-auto space-y-8">
            <!-- Sección de título -->
            <div class="text-center mb-8 animate-fade-in">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 dark:text-orange-500 flex items-center justify-center">
                    Evolución deportiva
                </h1>
                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 mt-2 max-w-2xl mx-auto">
                    Visualiza tus logros y supera tus propias metas
                </p>
            </div>

            <!-- Tarjeta de resumen mensual -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-5 sm:p-6 animate-slide-in transition-colors duration-300">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-white">
                        Resumen Mensual
                    </h2>
                </div>

                <!-- Estadísticas -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center transition-colors duration-300">
                        <p class="text-3xl sm:text-4xl font-bold text-orange-500">
                            {{ currentMonthHours }}
                        </p>
                        <p class="text-sm sm:text-base text-gray-500 dark:text-gray-300">
                            Horas este mes
                        </p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center transition-colors duration-300">
                        <p class="text-3xl sm:text-4xl font-bold text-blue-500">
                            {{ formattedProgressPercentage }}%
                        </p>
                        <p class="text-sm sm:text-base text-gray-500 dark:text-gray-300">
                            Progreso
                        </p>
                    </div>
                </div>

                <!-- Barra de progreso -->
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 transition-colors duration-300">
                    <h3 class="font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tu objetivo: {{ monthlyGoal }} horas
                    </h3>
                    <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-3">
                        <div 
                            class="bg-orange-500 h-3 rounded-full transition-all duration-500 ease-out"
                            :style="`width: ${progressPercentage}%`"
                        />
                    </div>
                    <p class="text-right text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                        {{ currentMonthHours }} de {{ monthlyGoal }} horas
                    </p>
                </div>
            </div>

            <!-- Secciones comentadas (se mantienen los estilos para cuando se activen) -->
            <!-- Gráfica de progreso -->
            <div v-if="false" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-5 sm:p-6 animate-slide-in transition-colors duration-300">
                <!-- Contenido de la gráfica -->
            </div>

            <!-- Ranking de amigos -->
            <div v-if="false" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-5 sm:p-6 animate-slide-in transition-colors duration-300">
                <!-- Contenido del ranking -->
            </div>

            <!-- Logros -->
            <div v-if="false" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-5 sm:p-6 animate-slide-in transition-colors duration-300">
                <!-- Contenido de logros -->
            </div>
        </div>
    </main>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
    reservations: Array,
    totalHours: [Number, String],
    totalActivities: Number,
    user: Object,
});

// Datos de progreso con valores por defecto seguros
const currentMonthHours = ref(0);
const monthlyGoal = ref(20); // Valor por defecto

// Cálculo seguro del porcentaje
const progressPercentage = computed(() => {
    const hours = parseFloat(currentMonthHours.value) || 0;
    const goal = parseFloat(monthlyGoal.value) || 1; // Evitar división por cero
    
    if (goal <= 0) return 0; // Si la meta es 0 o negativa
    
    const percentage = (hours / goal) * 100;
    return Math.min(percentage, 100); // No más del 100%
});

// Formateamos el porcentaje para mostrar (2 decimales)
const formattedProgressPercentage = computed(() => {
    // Si no hay progreso, mostrar 0.00%
    if (progressPercentage.value === 0) return '0.00';
    
    // Si es 100%, mostrarlo sin decimales
    if (progressPercentage.value >= 100) return '100';
    
    // Para otros valores, mostrar 2 decimales
    return progressPercentage.value.toFixed(2);
});

onMounted(() => {
    // Aseguramos que los valores sean numéricos
    currentMonthHours.value = parseFloat(props.totalHours) || 0;
    
    // Si el usuario tiene una meta definida, la usamos (validando primero)
    if (props.user?.monthly_goal !== undefined && props.user?.monthly_goal !== null) {
        monthlyGoal.value = parseFloat(props.user.monthly_goal) || 20;
    }
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