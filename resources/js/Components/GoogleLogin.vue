<template>
    <div class="mt-6">
        <button
            type="button"
            @click="loginWithGoogle"
            class="w-full inline-flex justify-center items-center px-4 py-3 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-all duration-200"
        >
            <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            <span class="ml-3">Continuar con Google</span>
        </button>
    </div>
</template>

<script setup>
const loginWithGoogle = () => {
    window.location.href = route('auth.google');
};



</script>

<!--

/*
TODO: ANTERIOR COMPONENTE, REVISAR FUNCIONAMIENTO
Este es el componente de GoogleLogin, puedes estilarlo para que sea intuitivo, como en el resto de paginas web que la gente sabe lo que hace el boton

<template>
    <div>
        <button
            type="button"
            class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 dark:border-gray-500 rounded-md shadow-sm text-sm font-medium hover:bg-gray-50 dark:hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            <!-- <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 3H3v18h18V3zM8 6h8v2H8zm0 4h8v2H8zm0 4h5v2H8z"></path>
            </svg> 
            <span class="ml-2"
                ><a :href="route('auth.google')">Google Login</a></span
            >
        </button>
    </div>
</template>

<script setup>
// import { route } from "vendor/tightenco/ziggy/src/js";
</script>

*/
-->