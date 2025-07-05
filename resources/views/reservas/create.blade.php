<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-center text-indigo-700 mb-6">Registrar Nueva Reserva</h1>
        <form action="{{ route('reservas.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del cliente</label>
                <input type="text" id="nombre" name="nombre" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none" value="{{ old('nombre') }}">
                @error('nombre')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="contacto" class="block text-sm font-medium text-gray-700 mb-1">Contacto</label>
                <input type="text" id="contacto" name="contacto" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none" value="{{ old('contacto') }}">
                @error('contacto')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <div class="flex flex-col md:flex-row gap-3">
                <div class="w-full md:w-1/2">
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                    <input type="date" id="fecha" name="fecha" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none" value="{{ old('fecha') }}">
                    @error('fecha')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
                <div class="w-full md:w-1/2">
                    <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                    <select id="hora" name="hora" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        <option value="">--:--</option>
                        @php
                            $horasManana = [10, 11, 12];
                            $horasTarde = [13, 14, 15, 16, 17, 18, 19, 20, 21, 22];
                            $minutos = ["00", "15", "30", "45"];
                        @endphp
                        @foreach($horasManana as $h)
                            @foreach($minutos as $m)
                                @if($h == 12 && in_array($m, ["30", "45"]))
                                    @continue
                                @endif
                                <option value="{{ sprintf('%02d:%s:00', $h, $m) }}" @if(old('hora') == sprintf('%02d:%s:00', $h, $m)) selected @endif>{{ sprintf('%02d:%s', $h, $m) }}</option>
                            @endforeach
                        @endforeach
                        @foreach($horasTarde as $h)
                            @foreach($minutos as $m)
                                @if($h == 13 && in_array($m, ["00", "15"]))
                                    @continue
                                @endif
                                <option value="{{ sprintf('%02d:%s:00', $h, $m) }}" @if(old('hora') == sprintf('%02d:%s:00', $h, $m)) selected @endif>{{ sprintf('%02d:%s', $h, $m) }}</option>
                            @endforeach
                        @endforeach
                    </select>
                    @error('hora')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
            </div>
            <div>
                <label for="servicio_id" class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                <select id="servicio_id" name="servicio_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <option value="">Selecciona un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}" @if(old('servicio_id') == $servicio->id) selected @endif>
                            {{ $servicio->nombre }} - S/ {{ number_format($servicio->precio, 2) }} ({{ $servicio->duracion }} min)
                        </option>
                    @endforeach
                </select>
                @error('servicio_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl">Registrar Reserva</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastDiv = document.getElementById('toast-success');
        if (toastDiv) {
            Toastify({
                text: toastDiv.getAttribute('data-message'),
                duration: 4000,
                gravity: "top",
                position: "center",
                backgroundColor: "#111",
                stopOnFocus: true,
                style: {
                    borderRadius: '10px',
                    fontWeight: 'bold',
                    fontSize: '1.1rem',
                    color: '#fff',
                    boxShadow: '0 4px 24px rgba(0,0,0,0.15)'
                }
            }).showToast();
        }
    });
</script>
</x-app-layout> 