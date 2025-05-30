<template>
    <Head title="¿Qué debo esperar en mi primera clase en FitWorking?" />

    <section class="min-h-screen bg-white p-10">
        <h1
            class="text-3xl font-bold text-gray-900 text-center mt-10 dark:text-orange-600"
        >
            ¿Qué debo esperar en mi primera clase en FitWorking?
        </h1>

        <!-- Botón de volver -->
        <div class="flex justify-center mt-6 md:justify-start mb-10">
            <button
                @click="() => router.visit(route('activities.index'))"
                class="bg-white w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
                type="button"
            >
                <div
                    class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 1024 1024"
                        height="25px"
                        width="25px"
                    >
                        <path
                            d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                            fill="#000000"
                        ></path>
                        <path
                            d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                            fill="#000000"
                        ></path>
                    </svg>
                </div>
                <p class="translate-x-2">Volver</p>
            </button>
        </div>

        <div class="max-w-4xl text-center mx-auto">
            <div
                class="relative rounded-lg overflow-hidden shadow-lg group hover:shadow-xl transition-shadow mb-8"
            >
                <img
                    src="https://images.unsplash.com/photo-1607962837359-5e7e89f86776?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Entrenamiento funcional"
                    class="w-full h-96 object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"
                ></div>
            </div>

            <p class="text-lg text-gray-700 mb-4">
                Es completamente normal sentirse nervioso antes de empezar algo
                nuevo. Pero en FitWorking, no tienes que hacerlo solo. Desde el
                primer momento que entres por la puerta, te recibirán con una
                sonrisa.
            </p>

            <p class="text-lg text-gray-700 mb-4">
                Te mostraremos el espacio, te presentaremos a tu entrenador y te
                explicaremos paso a paso qué ejercicios vas a hacer. No
                necesitas experiencia previa: adaptamos cada sesión a tu nivel,
                para que puedas avanzar con seguridad y confianza.
            </p>

            <p class="text-lg text-gray-700 mb-6">
                Solo necesitas ropa cómoda, calzado deportivo y ganas de
                empezar. Lo demás lo ponemos nosotros: atención, acompañamiento
                y una comunidad que te anima desde el primer día.
            </p>

            <button
                @click="router.visit(route('login'))"
                class="flex items-center mx-auto text-orange-500 font-medium hover:text-orange-600 transition-colors"
            >
                Registrate y empieza a cambiar
                <svg
                    class="w-4 h-4 ml-1"
                    viewBox="0 0 17 12"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12.749 6.451H0v-1.7h12.749L9.2 1.202 10.402 0l5.601 5.601-5.6 5.601L9.2 10l3.549-3.549Z"
                    />
                </svg>
            </button>
        </div>
    </section>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
</script>
