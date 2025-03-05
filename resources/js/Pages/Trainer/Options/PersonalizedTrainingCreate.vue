<template>
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full animate-fade-in">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">
            Visibilidad del Plan
        </h2>

        <div class="flex items-center justify-center gap-6">
            <label
                class="flex items-center gap-2 cursor-pointer transition transform hover:scale-105"
            >
                <input
                    type="radio"
                    v-model="opcion"
                    value="public"
                    class="hidden peer"
                />
                <div
                    class="w-5 h-5 border-2 border-blue-500 rounded-full flex items-center justify-center peer-checked:bg-blue-500"
                >
                    <div
                        class="w-2.5 h-2.5 bg-white rounded-full peer-checked:scale-100 scale-0 transition"
                    ></div>
                </div>
                <span class="text-gray-700 font-medium">Público</span>
            </label>

            <label
                class="flex items-center gap-2 cursor-pointer transition transform hover:scale-105"
            >
                <input
                    type="radio"
                    v-model="opcion"
                    value="private"
                    class="hidden peer"
                />
                <div
                    class="w-5 h-5 border-2 border-red-500 rounded-full flex items-center justify-center peer-checked:bg-red-500"
                >
                    <div
                        class="w-2.5 h-2.5 bg-white rounded-full peer-checked:scale-100 scale-0 transition"
                    ></div>
                </div>
                <span class="text-gray-700 font-medium">Privado</span>
            </label>
        </div>
    </div>

    <div v-if="opcion === 'public'" class="flex flex-col items-center p-6">
        <div
            class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg animate-fade-in"
        >
            <h1 class="text-3xl font-bold text-gray-800 text-center mb-4 mt-10">
                Crear Plan Personalizado
            </h1>
            <p class="text-gray-600 text-center mb-6">
                Diseña un plan a medida para tus clientes.
            </p>

            <form @submit.prevent="crearPlan">
                <!--  POR AHORA LO Comento pero es el NAME
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1"
                        >Nombre del plan</label
                    >
                    <input
                        v-model="plan.nombre"
                        type="text"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Ej: Plan de entrenamiento avanzado"
                        required
                    />
                </div> -->

                <!-- <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1"
                        >Duración (semanas)</label
                    >
                    <input
                        v-model="plan.duracion"
                        type="number"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                        min="1"
                        max="52"
                        required
                    />
                </div> -->

                <!-- Descripción -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1"
                        >Descripción</label
                    >

                    <textarea
                        v-model="plan.description"
                        rows="3"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Describe los objetivos y actividades del plan"
                        required
                    ></textarea>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1"
                        >Precio</label
                    >
                    <div class="flex gap-2">
                        <input
                            v-model="plan.euros"
                            type="number"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                            min="0"
                            required
                            placeholder="Euros"
                        />
                        <input
                            v-model="plan.centimos"
                            type="number"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                            placeholder="Centimos"
                            min="0"
                            max="99"
                            required
                        />
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition"
                >
                    Crear Plan
                </button>
            </form>
        </div>
    </div>
    <div v-else-if="opcion === 'private'">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-4 mt-20">
            Cargar el apartado de personalizar un plan para un cliente 'user'
        </h1>
    </div>
    <div v-else>
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-4 mt-20">
            Elige una opcion
        </h1>
    </div>
</template>

<script setup>
// Importaciones
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const opcion = ref(null);

const plan = ref({
    description: "",
    euros: "",
    centimos: "",
});

const crearPlan = () => {
    // alert(`✅ Plan "${plan.value.nombre}" creado con éxito!`);
    plan.value = {
        description: plan.value.description,
        price: plan.value.euros + "." + plan.value.centimos,
    };

    // Envio el plan al controlador
    router.post(route("trainers.storePlan"), plan.value);
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
</style>
