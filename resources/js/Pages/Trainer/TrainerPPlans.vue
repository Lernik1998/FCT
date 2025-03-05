<template>
    <!-- Barra navegación del Trainer -->
    <nav class="p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Marina Alta Sports</div>
            <TrainersNavBar />
        </div>
    </nav>

    <div class="flex flex-col text-center mt-20">
        <h1 class="text-4xl font-extrabold text-gray-800 animate-fade-in">
            Trainer Personal Plans
        </h1>
        <p class="text-lg text-gray-600 mt-2 mb-10">
            Diseña y gestiona planes personalizados para cada usuario.
        </p>

        <div>
            <a :href="route('trainers.createPlan')" class="text-blue-500"
                >Crear plan</a
            >
        </div>
    </div>

    <section>
        <template v-if="plans.length > 0">
            <div v-for="plan in plans" :key="plan.id">
                <table class="min-w-full bg-white border rounded-lg mt-10">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <!-- <th class="py-3 px-4 text-left">Nombre</th> -->
                            <th class="py-3 px-4 text-left">Descripción</th>
                            <th class="py-3 px-4 text-center">Precio</th>
                            <th class="py-3 px-4 text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- <td class="py-3 px-4">{{ plan.name }}</td> -->
                            <td class="py-3 px-4">{{ plan.description }}</td>
                            <td class="py-3 px-4 text-center">
                                {{ plan.price }}
                            </td>
                            <td
                                class="py-3 px-4 text-center"
                                v-if="plan.status == 1"
                            >
                                Activo
                            </td>
                            <td class="py-3 px-4 text-center" v-else>
                                Inactivo
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
        <template v-else>
            <p class="text-lg text-gray-600 mt-10 ml-20">
                No hay planes personalizados
            </p>
        </template>
    </section>
</template>

<script setup>
// Importaciones
import { defineProps } from "vue";

// Componentes
import TrainersNavBar from "./Components/TrainersNavBar.vue";

// Props
const props = defineProps({
    plans: Array,
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

.animate-fade-in {
    animation: fade-in 0.8s ease-out;
}
</style>
