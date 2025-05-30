<template>
    <Head title="¿Cómo cambiará tu cuerpo con FitWorking?" />

    <section
        class="min-h-screen bg-white p-10 flex flex-col items-center text-center"
    >
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

        <div class="max-w-3xl">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">
                ¿Cómo cambiará tu cuerpo con FitWorking?
            </h1>
            <p class="text-lg text-gray-700 mb-6 mt-10">
                Cada cuerpo es único, pero hay algo que se repite en quienes se
                comprometen: el cambio llega. Y no solo en lo que ves frente al
                espejo, sino en lo que sientes cada día al levantarte.
            </p>
            <p class="text-lg text-gray-700 mb-6 mt-10">
                En FitWorking empezarás a notar una mayor fuerza funcional, más
                resistencia cardiovascular y una mejor postura. Tu energía
                aumentará, y tareas cotidianas que antes costaban, ahora fluirán
                con naturalidad.
            </p>
            <p class="text-lg text-gray-700 mb-6 mt-10">
                Además, combinamos el entrenamiento con pautas de nutrición y
                bienestar pensadas para que tu progreso no solo sea visible,
                sino sostenible. Dormirás mejor, rendirás más en el trabajo y,
                lo más importante, te sentirás más en control de tu cuerpo.
            </p>
            <p class="text-lg text-gray-700 mb-8 mt-10">
                Los cambios físicos llegarán si tú decides empezar. No buscamos
                cuerpos perfectos, buscamos personas reales que quieran sentirse
                mejor cada semana.
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
