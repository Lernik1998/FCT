<template>
    <div
        class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 px-4"
    >
        <div class="max-w-5xl mx-auto">
            <!-- Gráfico de actividades -->
            <div
                class="bg-white rounded-xl shadow-sm p-6 mb-10 transition-all hover:shadow-md"
            >
                <div class="flex justify-between items-center mb-6">
                    <h2
                        class="text-2xl font-semibold text-gray-800 flex items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 mr-2 text-orange-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                            />
                        </svg>
                        Participación en Actividades
                    </h2>
                    <select
                        class="bg-white border border-gray-200 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    >
                        <option>Últimos 6 meses</option>
                        <option>Este año</option>
                        <option>Último año</option>
                    </select>
                </div>
                <div class="h-[400px]">
                    <canvas id="activitiesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from "vue";
import Chart from "chart.js/auto";

onMounted(() => {
    // Configuración común para ambos gráficos
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = "#6B7280";
    Chart.defaults.borderColor = "#E5E7EB";

    // Gráfico de actividades (barras)
    const activitiesCtx = document.getElementById("activitiesChart");
    new Chart(activitiesCtx, {
        type: "bar",
        data: {
            labels: [
                "Acuáticos",
                "Danza",
                "Pilates",
                "Actividades infantiles",
                "Planes personalizados",
                "Expediciones",
            ],
            datasets: [
                {
                    label: "Participantes",
                    data: [24, 38, 15, 25, 12, 18],
                    backgroundColor: [
                        "rgba(249, 115, 22, 0.2)",
                        "rgba(16, 185, 129, 0.2)",
                        "rgba(59, 130, 246, 0.2)",
                        "rgba(168, 85, 247, 0.2)",
                        "rgba(236, 72, 153, 0.2)",
                        "rgba(20, 184, 166, 0.2)",
                    ],
                    borderColor: [
                        "rgba(249, 115, 22, 1)",
                        "rgba(16, 185, 129, 1)",
                        "rgba(59, 130, 246, 1)",
                        "rgba(168, 85, 247, 1)",
                        "rgba(236, 72, 153, 1)",
                        "rgba(20, 184, 166, 1)",
                    ],
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    backgroundColor: "#1F2937",
                    titleFont: {
                        weight: "bold",
                        size: 14,
                    },
                    bodyFont: {
                        size: 12,
                    },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: "#E5E7EB",
                    },
                    ticks: {
                        stepSize: 10,
                    },
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false,
                    },
                },
            },
        },
    });
});
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap");

body {
    font-family: "Inter", sans-serif;
}
</style>
