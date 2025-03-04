<template>
    <div class="flex flex-col items-center">
        <div class="w-[800px] h-[400px]">
            <canvas id="myChart"></canvas>
        </div>

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
    const ctx = document.getElementById("myChart");

    // Configuración del gráfico
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "Acuaticos",
                "Danza",
                "Pilates",
                "Actividades infantiles",
                "Planes personalizados",
                "Expediciones",
            ],
            datasets: [
                {
                    label: "Actividades",
                    // Por ahora solo hay 6 datos, pero serán dinámicos
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(20, 20, 64, 0.2)",
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(20, 20, 64, 1)",
                    ],
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
