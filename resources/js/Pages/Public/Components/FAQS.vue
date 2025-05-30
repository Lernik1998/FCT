<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Encabezado -->
        <div class="flex justify-between items-center mb-12">
            <h2
                class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-orange-500"
            >
                <!-- FitWorking es para ti -->
                {{ $t("pages.Faq1.why_fitworking.section_title") }}
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
                        {{ $t("pages.Faq1.why_fitworking.articles.0.title") }}
                    </h3>
                    <p class="text-gray-600 dark:text-white">
                        {{ $t("pages.Faq1.why_fitworking.articles.0.content") }}
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
                        {{ $t("pages.Faq1.why_fitworking.articles.1.title") }}
                    </h3>
                    <p class="text-gray-600 dark:text-white mb-4">
                        {{ $t("pages.Faq1.why_fitworking.articles.1.content") }}
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
                        {{ $t("pages.Faq1.why_fitworking.articles.2.title") }}
                    </h3>
                    <p class="text-gray-600 dark:text-white mb-4">
                        {{ $t("pages.Faq1.why_fitworking.articles.2.content") }}
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
