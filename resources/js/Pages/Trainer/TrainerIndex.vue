<template>
    <!-- Barra navegación del Trainer -->
    <nav class="p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Marina Alta Sports</div>
            <TrainersNavBar />
        </div>
    </nav>

    <!-- <h1>Bienvenido {{ $props.trainer.name }}</h1> -->

    <section class="mt-10">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">
                <h1>Gestión de actividades</h1>

                <a
                    :href="route('trainers.createActivity')"
                    class="text-blue-500"
                    >Crear actividad</a
                >

                <p>
                    El admin debe de aceptar la solicitud de generación del plan
                </p>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">
                <h1>Cargar estadisticas</h1>
                <TrainerChart />
            </div>
        </div>
    </section>
</template>

<script setup>
// Importaciones

// Componentes
import TrainersNavBar from "./Components/TrainersNavBar.vue";
import TrainerChart from "./Components/TrainerChart.vue";
</script>

<style scoped>
/* Animaciones y estilos adicionales si es necesario */
</style>
