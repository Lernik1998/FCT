<template>
    <pre>{{ plans }}</pre>

    <div class="max-w-5xl mx-auto mt-10">
        <!-- Botón de volver -->
        <button
            @click="() => router.visit(route('admin.index'))"
            class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
            type="button"
        >
            <div
                class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1024 1024"
                    height="25px"
                    width="25px"
                >
                    <path
                        d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                        fill="#000000"
                    ></path>
                    <path
                        d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                        fill="#000000"
                    ></path>
                </svg>
            </div>
            <p class="translate-x-2">Volver</p>
        </button>

        <h1
            class="text-2xl font-bold text-gray-800 mb-6 text-center dark:text-orange-600"
        >
            Tipos de suscripciones
        </h1>

        <div class="flex justify-end mb-4">
            <button
                @click="createMembership"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-xl transition duration-200"
            >
                Crear membresía
            </button>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-2xl">
            <table class="min-w-full table-auto text-left text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="px-6 py-4">Nombre</th>
                        <th class="px-6 py-4">Precio (€)</th>
                        <th class="px-6 py-4">Duración</th>
                        <th class="px-6 py-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="plan in plans"
                        :key="plan.id"
                        class="border-b hover:bg-gray-50"
                    >
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ plan.name }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ plan.price }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ plan.duration == "month" ? "Mensual" : "Anual" }}
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <button
                                @click="deleteMembership(plan.id)"
                                class="text-red-600 hover:underline font-medium"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <tr v-if="plans.length === 0">
                        <td
                            colspan="4"
                            class="text-center text-gray-500 px-6 py-4"
                        >
                            No hay planes disponibles.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({
    plans: Array,
});

function createMembership() {
    router.visit(route("admin.createMembershipView"));
}

function deleteMembership(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta membresía?")) {
        router.delete(route("admin.destroyMembership", { id }));
    }
}
</script>
