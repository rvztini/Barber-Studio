@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
    <div class="w-full max-w-xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">Reserva tu cita</h1>
        <form action="/reservar" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del cliente</label>
                <input type="text" id="nombre" name="nombre" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>
            <div>
                <label for="contacto" class="block text-sm font-medium text-gray-700 mb-1">Contacto</label>
                <input type="text" id="contacto" name="contacto" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>
            <div class="flex flex-col md:flex-row gap-3">
                <div class="w-full md:w-1/2">
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                    <input type="date" id="fecha" name="fecha" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <div class="w-full md:w-1/2">
                    <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                    <input type="time" id="hora" name="hora" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
            </div>
            <div>
                <label for="servicio_id" class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                <select id="servicio_id" name="servicio_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <option value="">Selecciona un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">
                            {{ ucfirst($servicio->nombre) }} - ${{ number_format($servicio->precio, 2) }} ({{ $servicio->duracion }} min)
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl">Reservar cita</button>
        </form>
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
                    boxShadow: '0 4px 24px rgba(0,0,0,0.15)'
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
