<template>
    <!-- Barra de navegación mejorada -->
    <nav class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- <img src="/logo-fitworking-white.png" alt="FitWorking Logo" class="h-8"> -->
                <h1 class="text-xl font-bold">Panel de Entrenador</h1>
            </div>
            <TrainersNavBar />
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container mx-auto py-8 px-4 sm:px-6">
        <!-- Bienvenida -->
        <div class="mb-10 bg-white rounded-xl shadow-lg p-6 animate-fade-in">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                        <!-- ¡Bienvenido, {{ trainer.name }}! -->
                    </h1>
                    <p class="text-gray-600 mt-2">
                        Gestiona tus actividades y sigue el progreso de tus clientes
                    </p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center">
                    <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Entrenador verificado
                    </span>
                </div>
            </div>
        </div>

        <!-- Tarjetas de resumen -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-500">Actividades activas</h3>
                    <div class="bg-orange-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-gray-800">12</p>
                <p class="text-sm text-gray-500 mt-1">+2 esta semana</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-500">Clientes activos</h3>
                    <div class="bg-blue-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-gray-800">24</p>
                <p class="text-sm text-gray-500 mt-1">+5 este mes</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-500">Ingresos este mes</h3>
                    <div class="bg-green-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-3xl font-bold text-gray-800">1,850€</p>
                <p class="text-sm text-gray-500 mt-1">+15% respecto al mes pasado</p>
            </div>
        </div>

        <!-- Gestión de actividades -->
        <section class="mb-10 bg-white rounded-xl shadow-lg overflow-hidden animate-slide-in">
            <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Gestión de Actividades
                </h2>
                <a :href="route('trainers.createActivity')" class="mt-3 md:mt-0 bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Crear nueva actividad
                </a>
            </div>
            
            <div class="p-6 bg-gray-50">
                <div class="alert bg-blue-50 text-blue-800 p-4 rounded-lg border border-blue-100 mb-6">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h4 class="font-bold">Aprobación de actividades</h4>
                            <p class="text-sm">Todas las nuevas actividades deben ser aprobadas por el administrador antes de ser publicadas. Recibirás una notificación cuando tu actividad sea revisada.</p>
                        </div>
                    </div>
                </div>

                <!-- Lista de actividades (simplificada) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div v-for="i in 3" :key="i" class="bg-white rounded-lg border border-gray-200 p-4 hover:border-orange-300 transition-colors">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800">Entrenamiento Funcional Avanzado</h3>
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pendiente</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Lunes y Miércoles - 18:00 a 19:30</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm text-gray-500">12 plazas disponibles</span>
                            <button class="text-sm text-orange-500 hover:text-orange-700">Editar</button>
                        </div>
                    </div>
                    
                    <div v-for="i in 3" :key="i+3" class="bg-white rounded-lg border border-gray-200 p-4 hover:border-orange-300 transition-colors">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800">Yoga Matutino</h3>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Aprobado</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Martes y Jueves - 8:00 a 9:00</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm text-gray-500">5 plazas disponibles</span>
                            <button class="text-sm text-orange-500 hover:text-orange-700">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Estadísticas y gráficos -->
        <section class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-in">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Estadísticas y Progreso
                </h2>
            </div>
            
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-3">Participación en tus actividades</h3>
                    <TrainerChart />
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Clientes nuevos</h3>
                        <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center text-gray-400">
                            [Gráfico de clientes nuevos]
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Evaluación promedio</h3>
                        <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center text-gray-400">
                            [Gráfico de evaluaciones]
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
// Componentes
import TrainersNavBar from "./Components/TrainersNavBar.vue";
import TrainerChart from "./Components/TrainerChart.vue";

// Props
defineProps({
    trainer: {
        type: Object,
        required: true
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