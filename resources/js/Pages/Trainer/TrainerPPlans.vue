<template>
    <!-- Barra de navegación mejorada -->
    <nav
        class="bg-gradient-to-r from-orange-500 to-red-600 p-4 text-white shadow-lg"
    >
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- <img src="/logo-fitworking-white.png" alt="FitWorking Logo" class="h-8"> -->
                <h1 class="text-xl font-bold">Planes Personalizados</h1>
            </div>
            <TrainersNavBar />
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container mx-auto py-8 px-4">
        <!-- Encabezado -->
        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                <span
                    class="bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-red-500"
                >
                    Gestión de planes
                </span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Crea y gestiona planes de entrenamiento personalizados para tus
                clientes
            </p>
        </div>

        <!-- Acciones principales -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-10">
            <!-- :href="route('trainers.createPlan')"  -->
            <a
                class="flex-1 sm:flex-none bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg shadow-md transition-all flex items-center justify-center"
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
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                </svg>
                Crear Nuevo Plan
            </a>

            <button
                @click="showPlanTypeSelector = true"
                class="flex-1 sm:flex-none border-2 border-orange-500 text-orange-500 hover:bg-orange-50 font-medium py-3 px-6 rounded-lg transition-all flex items-center justify-center"
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
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                    />
                </svg>
                Filtrar Planes
            </button>
        </div>

        <!-- Lista de planes -->
        <div
            v-if="plans.length > 0"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
        >
            <div
                v-for="plan in filteredPlans"
                :key="plan.id"
                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow border border-gray-200"
            >
                <div class="p-5">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">
                            {{ plan.name }}
                        </h3>
                        <span
                            class="px-3 py-1 rounded-full text-xs font-medium"
                            :class="
                                plan.status
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-gray-100 text-gray-800'
                            "
                        >
                            {{ plan.status ? "Activo" : "Inactivo" }}
                        </span>
                    </div>

                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ plan.description }}
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-orange-500">
                            {{ plan.price ? `${plan.price}€` : "Gratis" }}
                        </span>
                        <div class="flex space-x-2">
                            <!-- :href="route('trainers.editPlan', plan.id)" -->
                            <a
                                class="p-2 text-gray-500 hover:text-orange-500 hover:bg-orange-50 rounded-full transition-colors"
                                title="Editar plan"
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
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>
                            </a>
                            <button
                                @click="togglePlanStatus(plan)"
                                class="p-2 text-gray-500 hover:text-green-500 hover:bg-green-50 rounded-full transition-colors"
                                :title="
                                    plan.status
                                        ? 'Desactivar plan'
                                        : 'Activar plan'
                                "
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
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-gray-50 px-5 py-3 border-t border-gray-200 flex justify-between items-center"
                >
                    <span class="text-sm text-gray-500">
                        {{ formatDate(plan.created_at) }}
                    </span>
                    <span
                        class="text-xs px-2 py-1 rounded"
                        :class="
                            plan.type === 'free'
                                ? 'bg-blue-100 text-blue-800'
                                : 'bg-purple-100 text-purple-800'
                        "
                    >
                        {{
                            plan.type === "free"
                                ? "Plan Público"
                                : "Plan Privado"
                        }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Sin planes -->
        <div v-else class="bg-white rounded-xl shadow-sm p-10 text-center">
            <div class="mx-auto max-w-md">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-16 w-16 mx-auto text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                    />
                </svg>
                <h3 class="text-xl font-medium text-gray-700 mt-4">
                    No hay planes creados
                </h3>
                <p class="text-gray-500 mt-2">
                    Comienza creando tu primer plan personalizado para tus
                    clientes
                </p>
                <a
                    :href="route('trainers.createPlan')"
                    class="mt-6 inline-flex items-center px-4 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-colors"
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
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                        />
                    </svg>
                    Crear Primer Plan
                </a>
            </div>
        </div>

        <!-- Modal para seleccionar tipo de plan -->
        <div
            v-if="showPlanTypeSelector"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4">
                <div
                    class="p-5 border-b border-gray-200 flex justify-between items-center"
                >
                    <h3 class="text-lg font-semibold text-gray-800">
                        Filtrar Planes
                    </h3>
                    <button
                        @click="showPlanTypeSelector = false"
                        class="text-gray-500 hover:text-gray-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
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

                <div class="p-5 space-y-4">
                    <div
                        v-for="filter in planFilters"
                        :key="filter.value"
                        @click="
                            selectedFilter = filter.value;
                            showPlanTypeSelector = false;
                        "
                        class="p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 transition-colors"
                        :class="{
                            'border-orange-500 bg-orange-50':
                                selectedFilter === filter.value,
                        }"
                    >
                        <div class="flex items-center">
                            <div
                                class="mr-3 p-2 rounded-full"
                                :class="filter.bgColor"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    :class="filter.textColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">
                                    {{ filter.label }}
                                </h4>
                                <p class="text-sm text-gray-500">
                                    {{ filter.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <TrainerCalendar />
        </div>
    </main>
</template>

<script setup>
import { ref, computed } from "vue";
import TrainersNavBar from "./Components/TrainersNavBar.vue";
import TrainerCalendar from "./Components/TrainerCalendar.vue";

const props = defineProps({
    plans: Array,
});

// Estado para filtros
const showPlanTypeSelector = ref(false);
const selectedFilter = ref("all");

// Opciones de filtrado
const planFilters = [
    {
        value: "all",
        label: "Todos los planes",
        description: "Muestra todos tus planes públicos y privados",
        bgColor: "bg-gray-100",
        textColor: "text-gray-500",
    },
    {
        value: "free",
        label: "Planes públicos",
        description: "Planes gratuitos para todos los usuarios",
        bgColor: "bg-blue-100",
        textColor: "text-blue-500",
    },
    {
        value: "private",
        label: "Planes privados",
        description: "Planes personalizados para clientes específicos",
        bgColor: "bg-purple-100",
        textColor: "text-purple-500",
    },
    {
        value: "active",
        label: "Planes activos",
        description: "Muestra solo los planes actualmente activos",
        bgColor: "bg-green-100",
        textColor: "text-green-500",
    },
];

// Filtrar planes según selección
const filteredPlans = computed(() => {
    if (selectedFilter.value === "all") return props.plans;
    if (selectedFilter.value === "active")
        return props.plans.filter((plan) => plan.status);
    return props.plans.filter((plan) => plan.type === selectedFilter.value);
});

// Formatear fecha
const formatDate = (dateString) => {
    const options = { year: "numeric", month: "short", day: "numeric" };
    return new Date(dateString).toLocaleDateString("es-ES", options);
};

// Cambiar estado del plan
const togglePlanStatus = (plan) => {
    // Aquí iría la lógica para actualizar el estado en el backend
    plan.status = !plan.status;
    // Ejemplo con axios:
    // axios.patch(`/trainer/plans/${plan.id}/status`, { status: !plan.status })
    //   .then(response => plan.status = response.data.status)
};
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

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.line-clamp-3 {
    display: -webkit-box;
    /*-webkit-line-clamp: 3; */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.transition-colors {
    transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
