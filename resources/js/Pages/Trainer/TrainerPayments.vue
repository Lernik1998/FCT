<template>
    <!-- Navbar Trainer -->
    <nav class="p-4 mb-8">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">Marina Alta Sports</div>
            <TrainersNavBar />
        </div>
    </nav>

    <div>
        <h1>Trainer Payments</h1>
    </div>

    <div>
        <PaymentsChart />
    </div>
</template>
<script setup>
// Importaciones

// Componentes
import PaymentsChart from "./Components/PaymentsChart.vue";
import TrainersNavBar from "./Components/TrainersNavBar.vue";
</script>
