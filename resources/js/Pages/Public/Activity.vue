<template>
    <Head :title="'Actividades'" />

    <!-- Banner Principal con animación -->
    <section
        class="relative w-full h-96 overflow-hidden"
        style="
            background-image: url(/ownImages/actividadesIMG.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        "
    >
        <div
            class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-8"
        >
            <h1
                class="text-4xl font-bold mb-4 animate-slide-down text-orange-500"
            >
                FitWorking
            </h1>
            <p class="text-lg animate-fade-in">Explora lo mejor del deporte</p>
        </div>
    </section>

    <!-- Sección de Destacados con hover -->
    <section class="py-12 px-4 bg-gray-100 mt-8">
        <!-- <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-6">
                Actividades que puedes encontrar en FitWorking
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
                    <a
                        :href="route('activities.show', activity.id)"
                        class="text-blue-600 hover:underline"
                        >Leer más</a
                    >
                </div>
            </div>
        </div>  -->

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                v-for="activity in activities"
                class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300 flex flex-col"
            >
                <!-- Imagen de la actividad (puedes añadir una propiedad image a tus actividades) -->
                <div class="h-40 bg-gray-300 overflow-hidden">
                    <img
                        :src="activity.image || '/placeholder-actividad.jpg'"
                        :alt="activity.name"
                        class="w-full h-full object-cover"
                    />
                </div>
                <div class="p-4 flex-grow">
                    <h3
                        class="text-lg font-semibold mb-2 text-gray-800 line-clamp-1"
                    >
                        {{ activity.name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ activity.description }}
                    </p>
                </div>
                <div class="px-4 pb-4">
                    <a
                        :href="route('activities.show', activity.id)"
                        class="block w-full py-2 bg-orange-500 text-white text-center rounded hover:bg-orange-600 transition"
                    >
                        Ver detalles
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categorías Deportivas con efecto hover SE PUEDE PONER EN OTRO LUGAR, TANTO EN USER COMO EN PUBLIC TODO:-->
    <!-- <section class="py-12">
        <div class="container mx-auto text-center">
            <ActivityAutoSlideshow :activities="activities" />
        </div>
    </section> -->

    <!-- FAQS -->
    <FAQS />
</template>

<script setup>
// Componentes
// import ActivityAutoSlideshow from "./Components/ActivityAutoSlideshow.vue";
import FAQS from "./Components/FAQS.vue";
import PublicLayout from "@/Layouts/PublicLayout.vue";

defineOptions({ layout: PublicLayout });

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
