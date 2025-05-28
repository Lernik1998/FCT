<template>
    <div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
        <!-- Botón de volver -->
        <button
            @click="() => router.visit(route('admin.subscriptionAdmin'))"
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
            class="text-2xl font-semibold text-gray-800 mb-6 text-center dark:text-orange-600"
        >
            Crear membresía
        </h1>

        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1"
                    >Nombre</label
                >
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <div>
                <label for="price" class="block text-gray-700 font-medium mb-1"
                    >Precio (€)</label
                >
                <input
                    type="number"
                    id="price"
                    v-model="form.price"
                    required
                    step="0.01"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <div>
                <label
                    for="duration"
                    class="block text-gray-700 font-medium mb-1"
                    >Duración</label
                >
                <select
                    v-model="form.duration"
                    required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Selecciona una duración</option>
                    <option value="1">1 mes</option>
                    <option value="3">3 meses</option>
                    <option value="6">6 meses</option>
                    <option value="12">12 meses</option>
                </select>
            </div>

            <div class="text-center">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-xl transition duration-200"
                >
                    Crear membresía
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { reactive } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const form = reactive({
    name: "",
    price: "",
    duration: "",
});

const submit = () => {
    router.post(route("admin.storeMembership"), form);
};
</script>
