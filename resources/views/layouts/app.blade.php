<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Barber Studio') }} - Gestión de Reservas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Toastify CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

        <!-- Toastify JS -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Script para mostrar alertas -->
        <script>
            // Función para mostrar alertas con Toastify
            function showAlert(message, type = 'success') {
                Toastify({
                    text: message,
                    duration: 5000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#111",
                    stopOnFocus: true,
                    close: true,
                    style: {
                        borderRadius: '10px',
                        fontWeight: 'bold',
                        fontSize: '1.2rem',
                        color: '#fff',
                        boxShadow: '0 4px 24px rgba(0,0,0,0.15)',
                        marginTop: '60px',
                        zIndex: 9999
                    }
                }).showToast();
            }

            // Mostrar alertas de sesión si existen
            @if(session('success'))
                showAlert("{{ session('success') }}", 'success');
            @endif

            @if(session('error'))
                showAlert("{{ session('error') }}", 'error');
            @endif

            @if(session('warning'))
                showAlert("{{ session('warning') }}", 'warning');
            @endif

            @if(session('info'))
                showAlert("{{ session('info') }}", 'info');
            @endif
        </script>
    </body>
</html>
