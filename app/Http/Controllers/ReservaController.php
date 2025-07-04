<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Support\Facades\Toast;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        Reserva::create($validated);

        return redirect()->back()->with('success', 'Tu reserva fue registrada correctamente');
    }

    public function index(Request $request)
    {
        $query = $request->input('q');
        $reservas = Reserva::with('servicio')
            ->when($query, function ($qB) use ($query) {
                $qB->where('nombre', 'like', "%$query%")
                    ->orWhere('contacto', 'like', "%$query%") ;
            })
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->paginate(10)
            ->appends(['q' => $query]);
        return view('reservas.index', compact('reservas', 'query'));
    }

    public function showForm()
    {
        $servicios = Servicio::all();
        return view('welcome', compact('servicios'));
    }

    public function edit(Reserva $reserva)
    {
        $servicios = Servicio::all();
        return view('reservas.edit', compact('reserva', 'servicios'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio_id' => 'required|exists:servicios,id',
        ]);
        $reserva->update($validated);
        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente');
    }
}
