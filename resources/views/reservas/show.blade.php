<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-indigo-700">Detalles de la Reserva</h1>
                <a href="{{ route('reservas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors duration-200">
                    Volver a Reservas
                </a>
            </div>

            <!-- Información de la Reserva -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Información del Cliente</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nombre:</label>
                        <p class="text-lg font-semibold text-gray-800">{{ $reserva->nombre }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Contacto:</label>
                        <p class="text-lg font-semibold text-gray-800">{{ $reserva->contacto }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Fecha:</label>
                        <p class="text-lg font-semibold text-gray-800">{{ $reserva->fecha }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Hora:</label>
                        <p class="text-lg font-semibold text-gray-800">{{ $reserva->hora }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Servicio:</label>
                        <p class="text-lg font-semibold text-gray-800">{{ $reserva->servicio->nombre ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Precio del Servicio:</label>
                        <p class="text-lg font-semibold text-green-600">S/ {{ number_format($reserva->servicio->precio ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Sección de Pagos -->
            <div class="bg-white border rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Pagos Registrados</h2>
                    <a href="{{ route('reservas.pagos.create', $reserva->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Registrar Pago
                    </a>
                </div>

                @if($reserva->pagos->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-gray-200 rounded-lg overflow-hidden">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-4 text-center text-xs font-semibold text-gray-700">#</th>
                                    <th class="p-4 text-center text-xs font-semibold text-gray-700">Monto</th>
                                    <th class="p-4 text-center text-xs font-semibold text-gray-700">Método de Pago</th>
                                    <th class="p-4 text-center text-xs font-semibold text-gray-700">Fecha de Pago</th>
                                    <th class="p-4 text-center text-xs font-semibold text-gray-700">Estado</th>
                                    <th class="p-4 text-center text-xs font-semibold text-gray-700">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reserva->pagos as $pago)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-4 text-center text-sm text-gray-600">{{ $loop->iteration }}</td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Resumen de Pagos -->
                    <div class="mt-6 bg-blue-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Resumen de Pagos</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-blue-600">Total Pagado:</label>
                                <p class="text-xl font-bold text-green-600">S/ {{ number_format($reserva->pagos->where('estado', 'Pagado')->sum('monto'), 2) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-600">Pendiente:</label>
                                <p class="text-xl font-bold text-yellow-600">S/ {{ number_format($reserva->pagos->where('estado', 'Pendiente')->sum('monto'), 2) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-600">Saldo:</label>
                                <p class="text-xl font-bold text-red-600">S/ {{ number_format(($reserva->servicio->precio ?? 0) - $reserva->pagos->where('estado', 'Pagado')->sum('monto'), 2) }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <p class="text-gray-500 text-lg">No hay pagos registrados para esta reserva</p>
                        <p class="text-gray-400 text-sm mt-2">Haz clic en "Registrar Pago" para agregar el primer pago</p>
                    </div>
                @endif
            </div>

            <!-- Acciones -->
            <div class="mt-6 flex justify-center gap-4">
                <a href="{{ route('reservas.edit', $reserva->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-200">
                    Editar Reserva
                </a>
            </div>
        </div>
    </div>
</x-app-layout> 