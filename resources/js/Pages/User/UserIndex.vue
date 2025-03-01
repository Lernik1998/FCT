<template>
    <div>
        <!-- Barra de Navegación -->
        <nav class="bg-gray-600 p-4 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">Bienvenido, Usuario</h1>
                <ul class="flex space-x-6">
                    <li>Pondré un Nav bar en condiciones</li>
                    <li>
                        <a
                            href="#"
                            @click.prevent="logout"
                            class="hover:underline"
                        >
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido Principal -->
        <section class="container mx-auto py-12 px-4">
            <h2 class="text-3xl font-semibold text-center mb-6">Dashboard</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Tus Estadísticas</h3>
                    <p class="text-gray-700">
                        Visualiza tu progreso y métricas personales.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Próximos Eventos</h3>
                    <p class="text-gray-700">
                        Mantente al tanto de los próximos eventos deportivos.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Mensajes</h3>
                    <p class="text-gray-700">
                        Revisa mensajes y notificaciones importantes.
                    </p>
                </div>
            </div>
        </section>

        <!-- Pie de Página -->
    </div>
</template>

<script setup>
// Importaciones
import { router } from "@inertiajs/vue3";

// Función para cerrar sesión
const logout = () => {
    router.post(route("logout"));
};
</script>
