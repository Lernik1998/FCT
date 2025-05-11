<template>
    <section class="py-8 px-4 sm:px-6 dark:bg-gray-900">
        <h2 class="text-center text-2xl md:text-3xl font-semibold mb-8 dark:text-white">
            Nuestro equipo
        </h2>
        <div class="flex flex-wrap justify-center gap-6 max-w-7xl mx-auto">
            <!-- Team Member 1 -->
            <div class="w-full sm:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)]">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden h-full transition-transform hover:scale-[1.02] flex flex-col">
                    <div class="w-full h-64 md:h-80 overflow-hidden">
                        <img
                            src="../../../../../public/ownImages/ceo.jpg"
                            alt="Alicia Torres"
                            class="w-full h-full object-cover object-center"
                            loading="lazy"
                        />
                    </div>
                    <div class="p-6 text-center flex-grow">
                        <h2 class="text-xl font-bold dark:text-white">Alicia Torres</h2>
                        <p class="text-gray-500 dark:text-gray-400">CEO & Fundadora</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">
                            Apasionada del deporte y el bienestar, Alicia creó
                            FitWorking para combinar actividad física y comunidad en
                            un solo lugar.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="w-full sm:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)]">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden h-full transition-transform hover:scale-[1.02] flex flex-col">
                    <div class="w-full h-64 md:h-80 overflow-hidden">
                        <img
                            src="../../../../../public/ownImages/nutrition.avif"
                            alt="Elena Fernández"
                            class="w-full h-full object-cover object-center"
                            loading="lazy"
                        />
                    </div>
                    <div class="p-6 text-center flex-grow">
                        <h2 class="text-xl font-bold dark:text-white">Elena Fernández</h2>
                        <p class="text-gray-500 dark:text-gray-400">Preparador físico opositores</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">
                            Experta en alimentación saludable, ayuda a nuestros
                            miembros a optimizar su rendimiento.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="w-full sm:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)]">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden h-full transition-transform hover:scale-[1.02] flex flex-col">
                    <div class="w-full h-64 md:h-80 overflow-hidden">
                        <img
                            src="../../../../../public/ownImages/trainer.jpg"
                            alt="Carlos Méndez"
                            class="w-full h-full object-cover object-center"
                            loading="lazy"
                        />
                    </div>
                    <div class="p-6 text-center flex-grow">
                        <h2 class="text-xl font-bold dark:text-white">Carlos Méndez</h2>
                        <p class="text-gray-500 dark:text-gray-400">Nutricionista deportivo</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">
                            Con más de 10 años de experiencia, Carlos motiva a cada
                            persona a superar sus límites y alcanzar sus objetivos
                            físicos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'OutTeam'
}
</script>