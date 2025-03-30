<template>
    <div
        class="relative bg-gradient-to-br from-orange-50 to-white overflow-hidden shadow-2xl sm:rounded-2xl transition-all duration-500 hover:shadow-3xl hover:-translate-y-1"
        data-aos="fade-up"
    >
        <!-- Elementos decorativos -->
        <div
            class="absolute top-0 right-0 w-32 h-32 bg-orange-100 rounded-full opacity-20 transform translate-x-16 -translate-y-16"
        ></div>
        <div
            class="absolute bottom-0 left-0 w-48 h-48 bg-orange-200 rounded-full opacity-10 transform -translate-x-20 translate-y-20"
        ></div>

        <div class="relative p-8 md:p-10">
            <!-- Encabezado con icono -->
            <div class="flex items-center mb-6">
                <div class="p-3 bg-orange-500 rounded-lg shadow-md mr-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />
                    </svg>
                </div>
                <h1
                    class="text-3xl font-bold text-gray-900 font-serif tracking-tight"
                >
                    {{ name }}
                </h1>
            </div>

            <!-- Contenido -->
            <div class="space-y-6">
                <div class="relative group">
                    <div
                        class="absolute -left-4 top-0 h-full w-1 bg-orange-300 rounded-full transform origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-300"
                    ></div>
                    <p
                        class="text-2xl font-semibold text-gray-800 pl-4 transition-all duration-300 group-hover:translate-x-2"
                    >
                        Dirección web
                    </p>
                </div>

                <p
                    class="text-gray-600 leading-relaxed text-lg border-l-4 border-orange-200 pl-4 py-2 italic"
                >
                    "{{ description }}"
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(["name", "description"]);

// Para animaciones (opcional - requiere AOS library)
</script>

<style scoped>
/* Efecto de subrayado animado */
h1::after {
    content: "";
    display: block;
    width: 60px;
    height: 4px;
    background: #f97316;
    margin-top: 12px;
    transition: width 0.3s ease;
}

h1:hover::after {
    width: 100px;
}
</style>
