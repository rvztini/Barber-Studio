@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-indigo-700 mb-8 text-center">Reservas registradas</h1>
        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('reservas.index') }}" class="flex flex-1 justify-center">
                <input type="text" name="q" value="{{ old('q', $query ?? '') }}" placeholder="Buscar por nombre o contacto..." class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none text-center" />
                <button type="submit" class="ml-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors duration-200">Buscar</button>
            </form>
            <a href="{{ route('reservas.export') }}" class="ml-4 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" /></svg>
                Exportar Excel
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">#</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Nombre</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Contacto</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Fecha</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Hora</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Servicio</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Precio</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Duración</th>
                        <th class="p-4 text-center text-xs font-semibold text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservas as $reserva)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-4 text-center text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="p-4 text-center text-sm text-gray-800">{{ $reserva->nombre }}</td>
                            <td class="p-4 text-center text-sm text-gray-800">{{ $reserva->contacto }}</td>
                            <td class="p-4 text-center text-sm text-gray-800">{{ $reserva->fecha }}</td>
                            <td class="p-4 text-center text-sm text-gray-800">{{ $reserva->hora }}</td>
                            <td class="p-4 text-center text-sm text-gray-800">{{ $reserva->servicio->nombre ?? '-' }}</td>
                            <td class="p-4 text-center text-sm text-gray-800">S/ {{ number_format($reserva->servicio->precio ?? 0, 2) }}</td>
                            <td class="p-4 text-center text-sm text-gray-800">{{ $reserva->servicio->duracion ?? '-' }} min</td>
                            <td class="p-4 text-center flex justify-center gap-2">
                                <a href="{{ route('reservas.show', $reserva->id) }}" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors duration-200 text-xs font-semibold">Ver Pagos</a>
                                <a href="{{ route('reservas.edit', $reserva->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors duration-200 text-xs font-semibold">Editar</a>
                                <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta reserva?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded transition-colors duration-200 text-xs font-semibold">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-8 text-center text-gray-500">No hay reservas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reservas->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $reservas->links('vendor.pagination.tailwind') }}
        </div>
        @endif
        <div class="mt-8 text-center">
            <a href="/" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200 shadow">Volver al formulario</a>
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