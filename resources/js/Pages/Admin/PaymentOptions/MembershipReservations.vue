<template>
    <div class="bg-white min-h-screen p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Reservas de membresías
        </h1>

        <section class="bg-white shadow-md rounded-2xl overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Reservas
                </h2>
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full table-auto border border-gray-200 rounded-lg"
                    >
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium"
                                >
                                    Nombre
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium"
                                >
                                    Tipo de membresía
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium"
                                >
                                    Correo
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium"
                                >
                                    Estado
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-sm font-medium"
                                >
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            <tr
                                v-for="membership in memberships"
                                :key="membership.id"
                                class="hover:bg-gray-50 border-t"
                            >
                                <td class="px-6 py-4">{{ membership.name }}</td>
                                <td class="px-6 py-4">
                                    {{
                                        membership.membership?.type ??
                                        "Sin tipo"
                                    }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ membership.email }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        :class="
                                            membership.membership
                                                ?.stripe_status === 'active'
                                                ? 'text-green-600 font-semibold'
                                                : 'text-red-500 font-semibold'
                                        "
                                    >
                                        {{
                                            membership.membership
                                                ?.stripe_status === "active"
                                                ? "Activa"
                                                : "Inactiva"
                                        }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button
                                        @click="
                                            showMembership(
                                                membership.membership.stripe_id
                                            )
                                        "
                                        class="text-blue-600 hover:underline font-medium"
                                    >
                                        Gestionar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- <pre>{{ memberships[0].membership.stripe_id }}</pre> -->
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({
    memberships: Array,
});

const showMembership = (membership) => {
    // console.log(membership);
    router.get(route("admin.paymentOptions", membership));
};
</script>
