<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-10">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-indigo-700">
                    @if(isset($reserva))
                        Registrar Pago - {{ $reserva->nombre }}
                    @else
                        Nuevo Pago
                    @endif
                </h1>
                <a href="{{ isset($reserva) ? route('reservas.show', $reserva->id) : route('pagos.index') }}" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            @if(isset($reserva))
                <!-- Información de la reserva -->
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <h3 class="text-sm font-medium text-blue-800 mb-2">Información de la Reserva</h3>
                    <div class="text-sm text-blue-700">
                        <p><strong>Cliente:</strong> {{ $reserva->nombre }}</p>
                        <p><strong>Servicio:</strong> {{ $reserva->servicio->nombre ?? 'N/A' }}</p>
                        <p><strong>Precio del servicio:</strong> S/ {{ number_format($reserva->servicio->precio ?? 0, 2) }}</p>
                        <p><strong>Fecha:</strong> {{ $reserva->fecha }} a las {{ $reserva->hora }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ isset($reserva) ? route('reservas.pagos.store', $reserva->id) : route('pagos.store') }}" method="POST" class="space-y-5">
                @csrf
                
                @if(!isset($reserva))
                    <div>
                        <label for="reserva_id" class="block text-sm font-medium text-gray-700 mb-1">Reserva</label>
                        <select id="reserva_id" name="reserva_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                            <option value="">Selecciona una reserva</option>
                            @foreach($reservas as $reservaOption)
                                <option value="{{ $reservaOption->id }}" @if(old('reserva_id') == $reservaOption->id) selected @endif>
                                    {{ $reservaOption->nombre }} - {{ $reservaOption->servicio->nombre ?? 'N/A' }} ({{ $reservaOption->fecha }})
                                </option>
                            @endforeach
                        </select>
                        @error('reserva_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                @endif

                <div>
                    <label for="monto" class="block text-sm font-medium text-gray-700 mb-1">Monto (S/)</label>
                    <input type="number" step="0.01" id="monto" name="monto" value="{{ old('monto') }}" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                           placeholder="0.00">
                    @error('monto')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="metodo_pago" class="block text-sm font-medium text-gray-700 mb-1">Método de Pago</label>
                    <select id="metodo_pago" name="metodo_pago" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        <option value="">Selecciona un método de pago</option>
                        <option value="Yape" @if(old('metodo_pago') == 'Yape') selected @endif>Yape</option>
                        <option value="Plin" @if(old('metodo_pago') == 'Plin') selected @endif>Plin</option>
                        <option value="Efectivo" @if(old('metodo_pago') == 'Efectivo') selected @endif>Efectivo</option>
                        <option value="Tarjeta" @if(old('metodo_pago') == 'Tarjeta') selected @endif>Tarjeta</option>
                    </select>
                    @error('metodo_pago')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="fecha_pago" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Pago</label>
                    <input type="date" id="fecha_pago" name="fecha_pago" value="{{ old('fecha_pago', date('Y-m-d')) }}" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('fecha_pago')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select id="estado" name="estado" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        <option value="">Selecciona un estado</option>
                        <option value="Pendiente" @if(old('estado') == 'Pendiente') selected @endif>Pendiente</option>
                        <option value="Pagado" @if(old('estado') == 'Pagado') selected @endif>Pagado</option>
                        <option value="Cancelado" @if(old('estado') == 'Cancelado') selected @endif>Cancelado</option>
                    </select>
                    @error('estado')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl">
                    @if(isset($reserva))
                        Registrar Pago
                    @else
                        Crear Pago
                    @endif
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ isset($reserva) ? route('reservas.show', $reserva->id) : route('pagos.index') }}" 
                   class="text-indigo-600 hover:text-indigo-800 font-medium">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
</x-app-layout> 