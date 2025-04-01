<template>
    <!-- Footer Mejorado -->
    <footer
        class="bg-gradient-to-b from-gray-900 to-gray-800 text-white pt-12 pb-6 mt-4"
    >
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row justify-between items-start">
                <!-- Logo y Descripción -->
                <div class="mb-8 lg:mb-0 lg:max-w-xs">
                    <div class="flex items-center mb-4">
                        <!-- <img src="/logo-fitworking-white.png" alt="FitWorking Logo" class="h-10 mr-3"> -->
                        <span
                            class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-red-500"
                            >FitWorking</span
                        >
                    </div>

                    <div class="flex space-x-4">
                        <a
                            href="#"
                            class="text-gray-400 hover:text-white transition-colors"
                        >
                            <span class="sr-only">Facebook</span>
                            <svg
                                class="h-6 w-6"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </a>
                        <a
                            href="#"
                            class="text-gray-400 hover:text-white transition-colors"
                        >
                            <span class="sr-only">Instagram</span>
                            <svg
                                class="h-6 w-6"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.466.182 1.504.344 1.857.344.975.045 1.351.047 3.807.058h.468c2.456 0 2.784-.011 3.807-.058.975-.045 1.504-.207 1.857-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.047-1.023.058-1.351.058-3.807v-.468c0-2.456-.011-2.784-.058-3.807-.045-.975-.207-1.504-.344-1.857a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </a>
                        <a
                            href="#"
                            class="text-gray-400 hover:text-white transition-colors"
                        >
                            <span class="sr-only">Twitter</span>
                            <svg
                                class="h-6 w-6"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                                />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <p class="text-gray-300 mb-4">
                        Conectando a la comunidad deportiva. Encuentra, reserva
                        y disfruta de actividades deportivas cerca de ti.
                    </p>
                </div>

                <!-- Enlaces en columnas -->
                <!-- <div class="grid grid-cols-2 md:grid-cols-3 gap-10 w-full max-w-2xl">
                    <!-- Columna 1 
                    <div>
                        <h5 class="text-lg font-bold mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Descubre
                        </h5>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Eventos destacados
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Actividades populares
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Nuevos deportes
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Comunidades locales
                                </a>
                            </li>
                        </ul>
                    </div>


                    <!-- Columna 2 
                    <div>
                        <h5 class="text-lg font-bold mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                            Soporte
                        </h5>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Centro de ayuda
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Preguntas frecuentes
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Contactar soporte
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Guías de uso
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Columna 3 
                    <div>
                        <h5 class="text-lg font-bold mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            Legal
                        </h5>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Términos de servicio
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Política de privacidad
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Cookies
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Aviso legal
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>

            <!-- Newsletter -->
            <!-- <div class="mt-12 border-t border-gray-700 pt-8">
                <div class="max-w-2xl mx-auto text-center">
                    <h3 class="text-xl font-bold mb-4">
                        ¡Mantente actualizado!
                    </h3>
                    <p class="text-gray-300 mb-6">
                        Suscríbete a nuestro boletín para recibir las últimas
                        novedades y eventos deportivos.
                    </p>
                    <form
                        class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto"
                    >
                        <input
                            type="email"
                            placeholder="Tu email"
                            class="flex-grow px-4 py-2 rounded-full bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        />
                        <button
                            type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-full transition-colors shadow-lg"
                        >
                            Suscribirse
                        </button>
                    </form>
                </div>
            </div> -->

            <!-- Derechos de autor -->
            <div
                class="mt-8 pt-6 border-t border-gray-700 flex flex-col md:flex-row justify-between items-center"
            >
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    © 2025 FitWorking. Todos los derechos reservados.
                </p>
                <div class="flex space-x-6">
                    <a
                        href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors"
                        >Términos de uso</a
                    >
                    <a
                        href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors"
                        >Política de privacidad</a
                    >
                    <a
                        href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors"
                        >Configuración de cookies</a
                    >
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
.transition-colors {
    transition: color 0.3s ease, background-color 0.3s ease;
}

.hover\:text-orange-400:hover {
    color: #f97316;
}
</style>
