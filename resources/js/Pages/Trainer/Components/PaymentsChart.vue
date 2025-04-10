<template>
    <!-- Gráfico de ingresos -->
    <div
        class="bg-white rounded-xl shadow-sm p-6 transition-all hover:shadow-md"
    >
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
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
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                Distribución de Ingresos
            </h2>
            <select
                class="bg-white border border-gray-200 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
            >
                <option>Primer semestre</option>
                <option>Segundo semestre</option>
                <option>Año completo</option>
            </select>
        </div>
        <div class="h-[400px]">
            <canvas id="incomeChart"></canvas>
        </div>
    </div>
</template>

<script setup>
// Importaciones
import { onMounted } from "vue";
import Chart from "chart.js/auto";

onMounted(() => {
    // Gráfico de ingresos (dona)
    const incomeCtx = document.getElementById("incomeChart");
    new Chart(incomeCtx, {
        type: "doughnut",
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
            datasets: [
                {
                    label: "Ingresos (€)",
                    data: [1850, 2340, 1980, 2780, 1890, 2390],
                    backgroundColor: [
                        "rgba(249, 115, 22, 0.7)",
                        "rgba(249, 115, 22, 0.6)",
                        "rgba(249, 115, 22, 0.5)",
                        "rgba(249, 115, 22, 0.4)",
                        "rgba(249, 115, 22, 0.3)",
                        "rgba(249, 115, 22, 0.2)",
                    ],
                    borderColor: "#F3F4F6",
                    borderWidth: 2,
                    hoverOffset: 8,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: "70%",
            plugins: {
                legend: {
                    position: "right",
                    labels: {
                        boxWidth: 12,
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: "circle",
                    },
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
                    callbacks: {
                        label: function (context) {
                            return ` ${context.label}: ${context.raw}€`;
                        },
                    },
                },
            },
        },
    });
});
</script>
