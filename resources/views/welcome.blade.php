<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
        <div class="max-w-4xl mx-auto text-center px-4">
            <div class="bg-white rounded-2xl shadow-2xl p-12">
                <!-- Logo o Icono -->
                <div class="mb-8">
                    <div class="mx-auto w-24 h-24 bg-indigo-600 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Título Principal -->
                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    Barber Studio
                </h1>
                
                <p class="text-xl text-gray-600 mb-8">
                    Sistema de Gestión Administrativa
                </p>

                <!-- Descripción -->
                <div class="max-w-2xl mx-auto mb-12">
                    <p class="text-gray-600 leading-relaxed">
                        Bienvenido al sistema de gestión integral para barberías. 
                        Aquí podrás administrar servicios, reservas y pagos de manera eficiente.
                    </p>
                </div>

                <!-- Características -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Gestión de Servicios</h3>
                        <p class="text-gray-600 text-sm">Administra los servicios disponibles y sus precios</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Control de Reservas</h3>
                        <p class="text-gray-600 text-sm">Gestiona las citas y horarios de los clientes</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Seguimiento de Pagos</h3>
                        <p class="text-gray-600 text-sm">Controla los pagos y estados de las reservas</p>
                    </div>
                </div>

                <!-- Botón de Acceso -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl text-lg">
                        Acceder al Sistema
                    </a>
                </div>

                <!-- Información adicional -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        Sistema desarrollado para gestión administrativa interna
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
