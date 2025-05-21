{{-- resources/views/errors/419.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Página expirada</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex flex-col items-center justify-center bg-gray-100 px-4">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-6xl font-bold text-yellow-500 mb-4">419</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Página expirada en FitWorking</h2>
        <p class="text-gray-600 mb-6">
            La página ha expirado debido a inactividad. Por favor, actualiza la página e intenta nuevamente.
        </p>
        <a href="{{ url('/') }}"
            class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
            Volver al inicio
        </a>
    </div>
</body>

</html>