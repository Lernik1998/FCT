<template>
    <div>
        <!-- Barra de Navegación -->
        <nav class="bg-blue-600 p-4 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">Soporte</h1>
                <ul class="flex space-x-6">
                    <li><a href="#" class="hover:underline">Inicio</a></li>
                    <li><a href="#" class="hover:underline">Mis Tickets</a></li>
                    <li><a href="#" class="hover:underline">Cerrar Sesión</a></li>
                </ul>
            </div>
        </nav>

        <!-- Formulario de Contacto -->
        <section class="container mx-auto py-12 px-4">
            <h2 class="text-3xl font-semibold text-center mb-6">Abrir un Ticket</h2>
            <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Asunto</label>
                        <input type="text" class="w-full p-2 border rounded-lg" placeholder="Asunto del ticket">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Categoría</label>
                        <select class="w-full p-2 border rounded-lg">
                            <option>Soporte Técnico</option>
                            <option>Consulta General</option>
                            <option>Petición Especial</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Mensaje</label>
                        <textarea class="w-full p-2 border rounded-lg" rows="5" placeholder="Describe tu problema o consulta"></textarea>
                    </div>
                    <div class="text-center">
                        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Enviar Ticket</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Pie de Página -->
        <footer class="py-6 bg-gray-800 text-white text-center">
            <p>&copy; 2025 Soporte. Todos los derechos reservados.</p>
        </footer>
    </div>
</template>

<script setup>

</script>
