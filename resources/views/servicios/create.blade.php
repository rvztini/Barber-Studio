@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6 text-center">Nuevo servicio</h1>
        <form action="{{ route('servicios.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                @error('nombre')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                @error('precio')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="duracion" class="block text-sm font-medium text-gray-700 mb-1">Duración (minutos)</label>
                <input type="number" id="duracion" name="duracion" value="{{ old('duracion') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                @error('duracion')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl">Crear servicio</button>
            <div class="mt-4 text-center">
                <a href="{{ route('servicios.index') }}" class="text-indigo-600 hover:underline">Volver a la lista</a>
            </div>
        </form>
    </div>
</div>
@endsection 