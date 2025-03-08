<template>
    <div
        class="flex flex-col items-center bg-white rounded-lg shadow-xl p-8 max-w-md mx-auto mt-10"
    >
        <h1 class="text-4xl font-bold text-indigo-600 mb-6">Tiempo</h1>
        <div v-if="weather.main" class="flex items-center space-x-6 mb-6">
            <img
                class="w-28 h-28 rounded-full border-2 border-indigo-500"
                :src="`http://openweathermap.org/img/wn/${weather.weather[0].icon}@2x.png`"
                :alt="weather.weather[0].main"
            />
            <div class="text-center">
                <p class="text-2xl font-semibold text-gray-800">{{ city }}</p>
                <p class="text-lg text-gray-600">
                    Temperatura:
                    <span class="text-red-500">{{ weather.main.temp }}°C</span>
                </p>
                <p class="text-lg text-gray-600">
                    Humedad:
                    <span class="text-blue-500"
                        >{{ weather.main.humidity }}%</span
                    >
                </p>
                <p class="text-lg text-gray-600">
                    Viento:
                    <span class="text-green-500"
                        >{{ weather.wind.speed }} m/s</span
                    >
                </p>
            </div>
        </div>
        <div v-else class="text-lg text-center text-gray-500">
            <p>Cargando el tiempo...</p>
        </div>
        <input
            v-model="city"
            placeholder="Ingresa la ciudad"
            @keyup.stop="fetchWeather(city)"
            class="mt-4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const city = ref("Denia");
const weather = ref({});

const fetchWeather = async (city) => {
    try {
        // Hacemos la solicitud directamente a la API del clima
        const apiKey = "ad5c5aaec61f81669b4459cbd51dd4f6"; // Reemplaza con tu propia clave
        const response = await axios.get(
            `http://127.0.0.1:8000/api/weather?q=${city}`
        );
        weather.value = response.data;
    } catch (error) {
        console.error("Error fetching weather data:", error);
    }
};

// Al montar el componente, hacemos la solicitud de la ciudad predeterminada
fetchWeather(city.value);
</script>
