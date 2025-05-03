<template>
    <div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Crear Membresía</h1>

        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1">Nombre</label>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <div>
                <label for="price" class="block text-gray-700 font-medium mb-1">Precio (€)</label>
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
                <label for="duration" class="block text-gray-700 font-medium mb-1">Duración</label>
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
