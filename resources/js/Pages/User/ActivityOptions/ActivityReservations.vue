<template>
    <div class="bg-gray-100">
        <!-- Barra de Navegación -->
        <nav class="bg-black p-4 text-white flex justify-between items-center">
            <h1 class="text-xl font-bold">Bienvenido</h1>
            <UsersNavBar />
        </nav>

        <h1 class="text-3xl font-bold p-4">Reservas del usuario</h1>

        <!-- Reservas del usuario -->
        <section class="p-4">
            <table class="min-w-full bg-white border rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Estado</th>
                        <th class="py-3 px-4 text-left">Importe</th>
                        <th class="py-3 px-4 text-left">Fecha</th>
                        <th class="py-3 px-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="reservation in reservations"
                        :key="reservation.id"
                        class="hover:bg-gray-50"
                    >
                        <td class="py-3 px-4">{{ reservation.id }}</td>

                        <td class="py-3 px-4">
                            {{
                                reservation.status
                                    ? "Reservado"
                                    : "No Reservado"
                            }}
                        </td>
                        <td class="py-3 px-4">{{ reservation.price }} €</td>
                        <td class="py-3 px-4">
                            {{
                                new Date(
                                    reservation.created_at
                                ).toLocaleDateString()
                            }}
                        </td>
                        <td class="py-3 px-4 text-center space-x-4">
                            <!-- <a
                                :href="
                                    route(
                                        'activities.showUserActivity',
                                        reservation.activity.id
                                    )
                                "
                                class="text-blue-500 hover:underline"
                                >Información</a
                            > -->

                            <!-- Eliminar una reserva -->
                            <button
                                @click="deleteReservation(reservation.id)"
                                class="text-red-500 hover:underline"
                            >
                                Eliminar
                            </button>

                            <button
                                @click="payForReservation(reservation.id)"
                                class="text-blue-500 hover:underline"
                            >
                                Tramintar pago
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</template>

<script setup>
// Componentes
import UsersNavBar from "../Components/UsersNavBar.vue";

// Importaciones
import { router } from "@inertiajs/vue3";

// Props
const props = defineProps(["reservations"]);

// Funciones
const deleteReservation = (id) => {
    if (confirm("¿Seguro que deseas eliminar esta reserva?")) {
        router.delete(route("userActivitiesReservations.destroy", id));
    }
};

const payForReservation = (id) => {
    router.get(route("userActivitiesReservations.payForActivity", id));
};
</script>
