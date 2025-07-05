<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-indigo-700">Gestión de Pagos</h1>
                    <p class="text-gray-600 mt-2">Administra todos los pagos de las reservas</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('pagos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-200 shadow-lg">
                        Nuevo Pago
                    </a>
                    <a href="{{ route('pagos.export') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-200 shadow-lg">
                        Exportar
                    </a>
                </div>
            </div>

            <!-- Buscador -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <form method="GET" action="{{ route('pagos.index') }}" class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="q" value="{{ $query }}" 
                               placeholder="Buscar por nombre del cliente o contacto..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                        Buscar
                    </button>
                    @if($query)
                        <a href="{{ route('pagos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                            Limpiar
                        </a>
                    @endif
                </form>
            </div>

            <!-- Tabla -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">#</th>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">Cliente</th>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">Contacto</th>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">Servicio</th>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">Monto</th>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">Método</th>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">Fecha</th>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">Estado</th>
                            <th class="p-4 text-left text-sm font-semibold text-indigo-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pagos as $pago)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="p-4 text-center text-sm text-gray-600">{{ $loop->iteration }}</td>
                                <td class="p-4 text-center text-sm text-gray-800">{{ $pago->reserva->nombre ?? 'N/A' }}</td>
                                <td class="p-4 text-center text-sm text-gray-800">{{ $pago->reserva->contacto ?? 'N/A' }}</td>
                                <td class="p-4 text-center text-sm text-gray-800">{{ $pago->reserva->servicio->nombre ?? 'N/A' }}</td>
                                <td class="p-4 text-center text-sm font-semibold text-green-600">S/ {{ number_format($pago->monto, 2) }}</td>
                                <td class="p-4 text-center text-sm text-gray-800">{{ $pago->metodo_pago }}</td>
                                <td class="p-4 text-center text-sm text-gray-800">{{ $pago->fecha_pago }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($pago->estado === 'Pagado') bg-green-100 text-green-800
                                        @elseif($pago->estado === 'Pendiente') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $pago->estado }}
                                    </span>
                                </td>
                                <td class="p-4 text-center flex justify-center gap-2">
                                    <a href="{{ route('pagos.edit', $pago->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded transition-colors duration-200 text-xs font-semibold">Editar</a>
                                    <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este pago?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded transition-colors duration-200 text-xs font-semibold">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="p-8 text-center text-gray-500">No hay pagos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($pagos->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $pagos->links('vendor.pagination.tailwind') }}
            </div>
            @endif

            <!-- Resumen -->
            @if($pagos->count() > 0)
            <div class="mt-6 bg-blue-50 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Resumen de Pagos</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-600">Total de Pagos:</label>
                        <p class="text-xl font-bold text-blue-800">{{ \App\Models\Pago::count() }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-600">Total Pagado:</label>
                        <p class="text-xl font-bold text-green-600">S/ {{ number_format(\App\Models\Pago::where('estado', 'Pagado')->sum('monto'), 2) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-600">Pendiente:</label>
                        <p class="text-xl font-bold text-yellow-600">S/ {{ number_format(\App\Models\Pago::where('estado', 'Pendiente')->sum('monto'), 2) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-600">Cancelado:</label>
                        <p class="text-xl font-bold text-red-600">S/ {{ number_format(\App\Models\Pago::where('estado', 'Cancelado')->sum('monto'), 2) }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Navegación -->
            <div class="mt-8 text-center">
                <a href="{{ route('reservas.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200 shadow">
                    Ver Reservas
                </a>
            </div>
        </div>
    </div>
</x-app-layout> 