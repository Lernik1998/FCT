<template>
    <div class="flex flex-col items-center">
        <h2 class="text-2xl font-semibold mb-10 mt-10">Ingresos</h2>

        <div class="w-[800px] h-[400px]">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
</template>

<script setup>
// Importaciones
import { onMounted } from "vue";
import Chart from "chart.js/auto";

onMounted(() => {
    const ctx2 = document.getElementById("myChart2");

    // Gráfico para los ingresos
    new Chart(ctx2, {
        type: "doughnut",
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
            datasets: [
                {
                    label: "Ingresos",
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});
</script>
