<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Control
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Bienvenido, {{ Auth::user()->name }} 👋</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <a href="{{ url('/servicios') }}" class="block bg-indigo-600 hover:bg-indigo-700 text-white text-center font-semibold py-8 rounded-lg shadow-lg transition-colors duration-200 text-xl">
                            Servicios
                        </a>
                        <a href="{{ url('/reservas') }}" class="block bg-green-600 hover:bg-green-700 text-white text-center font-semibold py-8 rounded-lg shadow-lg transition-colors duration-200 text-xl">
                            Reservas
                        </a>
                        <a href="{{ url('/pagos') }}" class="block bg-yellow-600 hover:bg-yellow-700 text-white text-center font-semibold py-8 rounded-lg shadow-lg transition-colors duration-200 text-xl">
                            Pagos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
