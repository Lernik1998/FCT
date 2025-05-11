<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Encabezado -->
        <div class="flex justify-between items-center mb-12">
            <h2
                class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-orange-500"
            >
                <!-- FitWorking es para ti -->
                ¿Por qué esto es para ti?
            </h2>
        </div>

        <!-- Grid de artículos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Artículo 1 -->
            <article
                @click="irABeforeStart()"
                class="group rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800"
            >
                <div class="relative h-56 overflow-hidden">
                    <!-- <img
                            src="https://www.crossfit.com/wp-content/uploads/2020/05/13120645/ron-gets-fit-crossfit-new-york-city-1024x576.jpg"
                            alt="A Father's Promise: Losing 84 Pounds To Run With His Kids"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        /> -->

                    <img
                        src="https://images.unsplash.com/photo-1591258370814-01609b341790?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Entrenamiento funcional"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    />

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                    ></div>
                </div>
                <div class="p-6">
                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white mb-3"
                    >
                        ¿Necesito estar en forma antes de apuntarme a
                        FitWorking?
                    </h3>
                    <p class="text-gray-600 dark:text-white">
                        No necesitas "prepararte" antes de empezar; el
                        entrenamiento funcional está diseñado para que progreses
                        desde donde estés, con el apoyo de una comunidad que te
                        anima en cada paso. ¡El mejor momento para empezar es
                        ahora!
                    </p>
                </div>
            </article>

            <!-- Artículo 2 -->
            <article
                @click="irABodyChanges()"
                class="group rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800"
            >
                <div class="relative h-56 overflow-hidden">
                    <!-- <img
                            src="https://www.crossfit.com/wp-content/uploads/2023/08/13115933/go-beyond-physical-develop-grit-mental-strength-with-crossfit.jpg"
                            alt="Go Beyond The Physical: Developing Grit & Mental Strength with CrossFit"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        /> -->

                    <img
                        src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="Entrenamiento funcional"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                    ></div>
                </div>
                <div class="p-6">
                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white mb-3"
                    >
                        ¿Cómo cambiará mi cuerpo al apuntarme a FitWorking?
                    </h3>
                    <p class="text-gray-600 dark:text-white mb-4">
                        Tus objetivos y esfuerzo determinarán tus resultados. En
                        FitWorking, nuestros usuarios suelen sentirse más
                        fuertes y mejorar significativamente su resistencia.
                        Combinado con nuestras recomendaciones de nutrición y
                        bienestar, también notarás mejoras en tu salud general y
                        productividad.
                    </p>
                </div>
            </article>

            <!-- Artículo 3 -->
            <article
                @click="irFirstClass()"
                class="group rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800"
            >
                <div class="relative h-56 overflow-hidden">
                    <!-- <img
                            src="https://www.crossfit.com/wp-content/uploads/2023/01/13120951/annie-holmes-crossfit-member-auburn-magic-of-crossfit-1024x576.jpg"
                            alt="Annie at Auburn CrossFit"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        /> -->

                    <img
                        src="https://images.unsplash.com/photo-1607962837359-5e7e89f86776?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Entrenamiento funcional"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    />

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                    ></div>
                </div>
                <div class="p-6">
                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white mb-3"
                    >
                        ¿Qué debo esperar en mi primera clase en FitWorking?
                    </h3>
                    <p class="text-gray-600 dark:text-white mb-4">
                        Es normal sentirse nervioso, ¡y está bien! Desde saber
                        qué llevar hasta conocer a tu entrenador y aprender los
                        ejercicios, te guiaremos a través de todo el proceso.
                    </p>
                </div>
            </article>
        </div>
    </section>
</template>

<script setup>
import { router } from "@inertiajs/vue3";

const irABeforeStart = () => {
    router.visit(route("beforeStart"));
};

const irABodyChanges = () => {
    router.visit(route("bodyChanges"));
};

const irFirstClass = () => {
    router.visit(route("firstClass"));
};
</script>
