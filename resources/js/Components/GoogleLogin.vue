<template>
    <div>
        <button
            type="button"
            class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            <!-- <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 3H3v18h18V3zM8 6h8v2H8zm0 4h8v2H8zm0 4h5v2H8z"></path>
            </svg> -->
            <span class="ml-2"
                ><a :href="route('auth.google')">Google Login</a></span
            >
        </button>
    </div>
</template>

<script setup>
// import { route } from "vendor/tightenco/ziggy/src/js";
</script>
