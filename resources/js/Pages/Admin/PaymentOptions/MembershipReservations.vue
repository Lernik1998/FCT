<template>
    <Head title="Reservas de membresías" />

    <div class="bg-white dark:bg-gray-900 min-h-screen p-4 sm:p-6 md:p-8">
        <h1
            class="text-2xl sm:text-3xl font-bold mb-6 text-gray-800 dark:text-white"
        >
            Reservas de membresías
        </h1>

        <section
            class="bg-white dark:bg-gray-800 shadow-md rounded-2xl overflow-hidden"
        >
            <div class="p-4 sm:p-6">
                <h2
                    class="text-lg sm:text-xl font-semibold mb-4 text-gray-700 dark:text-gray-100"
                >
                    Reservas
                </h2>
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full table-auto border border-gray-200 dark:border-gray-700 rounded-lg"
                    >
                        <thead
                            class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200"
                        >
                            <tr>
                                <th
                                    class="px-4 py-2 sm:px-6 sm:py-3 text-left text-sm font-medium"
                                >
                                    Nombre
                                </th>
                                <th
                                    class="px-4 py-2 sm:px-6 sm:py-3 text-left text-sm font-medium"
                                >
                                    Tipo de membresía
                                </th>
                                <th
                                    class="px-4 py-2 sm:px-6 sm:py-3 text-left text-sm font-medium"
                                >
                                    Correo
                                </th>
                                <th
                                    class="px-4 py-2 sm:px-6 sm:py-3 text-left text-sm font-medium"
                                >
                                    Estado
                                </th>
                                <th
                                    class="px-4 py-2 sm:px-6 sm:py-3 text-left text-sm font-medium"
                                >
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-100">
                            <tr
                                v-for="membership in memberships"
                                :key="membership.id"
                                class="hover:bg-gray-50 dark:hover:bg-gray-700 border-t border-gray-200 dark:border-gray-600"
                            >
                                <td class="px-4 py-3 sm:px-6">
                                    {{ membership.name }}
                                </td>
                                <td class="px-4 py-3 sm:px-6">
                                    {{
                                        membership.membership?.type ??
                                        "Sin tipo"
                                    }}
                                </td>
                                <td class="px-4 py-3 sm:px-6">
                                    {{ membership.email }}
                                </td>
                                <td class="px-4 py-3 sm:px-6">
                                    <span
                                        :class="
                                            membership.membership
                                                ?.stripe_status === 'active'
                                                ? 'text-green-600 dark:text-green-400 font-semibold'
                                                : 'text-red-500 dark:text-red-400 font-semibold'
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
                                <td class="px-4 py-3 sm:px-6">
                                    <button
                                        @click="
                                            showMembership(
                                                membership.membership.stripe_id
                                            )
                                        "
                                        class="text-blue-600 dark:text-blue-400 hover:underline font-medium"
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
    router.get(route("admin.paymentOptions", membership));
};
</script>
