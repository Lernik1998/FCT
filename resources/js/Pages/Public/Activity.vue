<template>
    <div>
        <!-- Banner Principal con animación -->
        <section class="relative w-full h-72 overflow-hidden">
            <!-- <img
                class="w-full h-full object-cover opacity-80 transform scale-110 animate-fade-in"
                src="/storage/own_imgs/imgDeportes.jpg"
                alt="Imagen Deportes"
            /> -->
            <div
                class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-8 bg-black bg-opacity-50"
            >
                <h1 class="text-4xl font-bold mb-4 animate-slide-down">
                    Marina Alta Deportes
                </h1>
                <p class="text-lg animate-fade-in">
                    Explora lo mejor del deporte en la Costa Blanca Norte
                </p>
            </div>
        </section>

        <!-- Menú de Navegación -->
        <nav class="p-4 bg-blue-900 text-white shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">Marina Alta Sports</div>
                <NavBar />
            </div>
        </nav>

        <!-- Sección de Destacados con hover -->
        <section class="py-12 px-4 bg-gray-100">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Actividades de esta semana
                </h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <div
                        v-for="activity in activities"
                        class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300"
                    >
                        <h3 class="text-xl font-semibold mb-4 text-gray-600">
                            {{ activity.name }}
                        </h3>
                        <p class="text-gray-700 mb-4">
                            {{ activity.description }}
                        </p>
                        <a href="#" class="text-blue-600 hover:underline"
                            >Leer más</a
                        >
                    </div>
                </div>
            </div>
        </section>

        <!-- Categorías Deportivas con efecto hover -->
        <section class="py-12 bg-blue-50">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">
                    Categorías Deportivas
                </h2>
                <div
                    class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8"
                >
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300"
                    >
                        <h3 class="text-xl font-semibold mb-4">Surf</h3>
                        <p class="text-gray-700">
                            Las mejores olas y spots en la Marina Alta.
                        </p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300"
                    >
                        <h3 class="text-xl font-semibold mb-4">Ciclismo</h3>
                        <p class="text-gray-700">
                            Recorre las rutas más impresionantes de la región.
                        </p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300"
                    >
                        <h3 class="text-xl font-semibold mb-4">Baloncesto</h3>
                        <p class="text-gray-700">
                            Compite en los mejores torneos de baloncesto local.
                        </p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300"
                    >
                        <h3 class="text-xl font-semibold mb-4">Atletismo</h3>
                        <p class="text-gray-700">
                            Descubre las mejores competiciones de atletismo.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pie de Página -->
        <footer class="py-6 bg-blue-900 text-white">
            <div class="container mx-auto text-center">
                <p>
                    &copy; 2025 Marina Alta Sports. Todos los derechos
                    reservados.
                </p>
                <div class="mt-4">
                    <a href="#" class="hover:underline">Facebook</a>
                    |
                    <a href="#" class="hover:underline">Twitter</a>
                    |
                    <a href="#" class="hover:underline">Instagram</a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
// Importaciones
import NavBar from "./Components/NavBar.vue";

const props = defineProps(["activities"]);
</script>

<style scoped>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: scale(1.05);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes slide-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 1s ease-out;
}

.animate-slide-down {
    animation: slide-down 1s ease-out;
}
</style>
