<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Support\Facades\Toast;
use App\Exports\ReservasExport;
use Maatwebsite\Excel\Facades\Excel;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $reservas = Reserva::with('servicio')
            ->when($query, function ($qB) use ($query) {
                $qB->where('nombre', 'like', "%$query%")
                    ->orWhere('contacto', 'like', "%$query%") ;
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['q' => $query]);
        return view('reservas.index', compact('reservas', 'query'));
    }

    public function create()
    {
        $servicios = \App\Models\Servicio::all();
        return view('reservas.create', compact('servicios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        try {
            Reserva::create($validated);
            return redirect()->route('reservas.create')->with('success', '¡Reserva registrada con éxito!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al registrar la reserva. Por favor, inténtalo de nuevo.');
        }
    }

    public function show(Reserva $reserva)
    {
        $reserva->load(['servicio', 'pagos']);
        return view('reservas.show', compact('reserva'));
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
        
        try {
            $reserva->update($validated);
            return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la reserva. Por favor, inténtalo de nuevo.');
        }
    }

    public function destroy(Reserva $reserva)
    {
        try {
            $reserva->delete();
            return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la reserva. Por favor, inténtalo de nuevo.');
        }
    }

    public function export()
    {
        return Excel::download(new ReservasExport, 'reservas.xlsx');
    }
}
