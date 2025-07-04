<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barber Studio')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen antialiased">
    <nav class="bg-white shadow mb-8">
        <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-indigo-700">Barber Studio</a>
            <div class="space-x-4">
                <a href="/" class="text-gray-700 hover:text-indigo-600 font-medium transition">Reservar</a>
                <a href="/reservas" class="text-gray-700 hover:text-indigo-600 font-medium transition">Ver reservas</a>
                <a href="/servicios" class="text-gray-700 hover:text-indigo-600 font-medium transition">Ver servicios</a>
                <a href="/pagos" class="text-gray-700 hover:text-indigo-600 font-medium transition">Ver pagos</a>
            </div>
        </div>
    </nav>
    @yield('content')
    @stack('scripts')
</body>
</html> 