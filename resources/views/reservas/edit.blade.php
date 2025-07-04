@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6 text-center">Editar reserva</h1>
        <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del cliente</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $reserva->nombre) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>
            <div>
                <label for="contacto" class="block text-sm font-medium text-gray-700 mb-1">Contacto</label>
                <input type="text" id="contacto" name="contacto" value="{{ old('contacto', $reserva->contacto) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>
            <div class="flex gap-3">
                <div class="w-1/2">
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                    <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $reserva->fecha) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <div class="w-1/2">
                    <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                    <input type="time" id="hora" name="hora" value="{{ old('hora', $reserva->hora) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
            </div>
            <div>
                <label for="servicio_id" class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                <select id="servicio_id" name="servicio_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <option value="">Selecciona un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}" @if(old('servicio_id', $reserva->servicio_id) == $servicio->id) selected @endif>
                            {{ ucfirst($servicio->nombre) }} - S/ {{ number_format($servicio->precio, 2) }} ({{ $servicio->duracion }} min)
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl">Actualizar reserva</button>
            <div class="mt-4 text-center">
                <a href="{{ route('reservas.index') }}" class="text-indigo-600 hover:underline">Volver a la lista</a>
            </div>
        </form>
    </div>
</div>
@endsection 