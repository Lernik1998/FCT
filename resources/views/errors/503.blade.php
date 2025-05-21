<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Servicio no disponible</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .spin {
            animation: spin 3s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center bg-gray-100 px-4">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg text-center">
        <!-- <img src="{{ asset('ownImgs/logo') }}" alt="Logo FitWorking" class="w-24 h-24 mx-auto mb-4"> -->
        <div class="text-6xl font-bold text-pink-500 mb-4 spin">503</div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Servicio temporalmente no disponible</h2>
        <p class="text-gray-600 mb-6">
            Estamos renovando nuestros músculos digitales. ¡Vuelve pronto!
        </p>
        <a href="{{ url('/') }}"
            class="inline-block bg-[#F55622] hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
            Volver al inicio
        </a>
    </div>
</body>

</html>