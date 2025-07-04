@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-indigo-700">Gestión de Pagos</h1>
            <div class="flex gap-2">
                <a href="{{ route('pagos.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nuevo Pago
                </a>
                <a href="{{ route('pagos.export') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                    </svg>
                    Exportar Excel
                </a>
            </div>
        </div>

        <!-- Búsqueda -->
        <div class="mb-6">
            <form method="GET" action="{{ route('pagos.index') }}" class="flex flex-1 justify-center">
                <input type="text" name="q" value="{{ old('q', $query ?? '') }}" placeholder="Buscar por nombre o contacto del cliente..." 
                       class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none text-center" />
                <button type="submit" class="ml-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors duration-200">
                    Buscar
                </button>
            </form>
        </div>

        <!-- Tabla de Pagos -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">#</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Cliente</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Contacto</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Servicio</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Monto</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Método de Pago</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Fecha de Pago</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Estado</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Acciones</th>
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
                    <p class="text-xl font-bold text-blue-800">{{ $pagos->total() }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-600">Total Pagado:</label>
                    <p class="text-xl font-bold text-green-600">S/ {{ number_format($pagos->where('estado', 'Pagado')->sum('monto'), 2) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-600">Pendiente:</label>
                    <p class="text-xl font-bold text-yellow-600">S/ {{ number_format($pagos->where('estado', 'Pendiente')->sum('monto'), 2) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-600">Cancelado:</label>
                    <p class="text-xl font-bold text-red-600">S/ {{ number_format($pagos->where('estado', 'Cancelado')->sum('monto'), 2) }}</p>
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
@endsection

@push('scripts')
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function showCustomToast() {
            Toastify({
                text: @json(session('success')),
                duration: 6000,
                gravity: "top",
                position: "center",
                backgroundColor: "#111",
                stopOnFocus: true,
                style: {
                    borderRadius: '10px',
                    fontWeight: 'bold',
                    fontSize: '1.2rem',
                    color: '#fff',
                    boxShadow: '0 4px 24px rgba(0,0,0,0.15)',
                    marginTop: '60px'
                }
            }).showToast();
        }
        if (window.Toastify) {
            showCustomToast();
        } else {
            let tries = 0;
            let interval = setInterval(function() {
                if (window.Toastify) {
                    showCustomToast();
                    clearInterval(interval);
                }
                if (++tries > 10) clearInterval(interval);
            }, 200);
        }
    });
</script>
@endif
@endpush 