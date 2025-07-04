<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Reserva;
use App\Exports\PagosExport;
use Maatwebsite\Excel\Facades\Excel;

class PagoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $pagos = Pago::with('reserva.servicio')
            ->when($query, function ($qB) use ($query) {
                $qB->whereHas('reserva', function ($q) use ($query) {
                    $q->where('nombre', 'like', "%$query%")
                      ->orWhere('contacto', 'like', "%$query%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['q' => $query]);
        
        return view('pagos.index', compact('pagos', 'query'));
    }

    public function create()
    {
        $reservas = Reserva::with('servicio')->orderBy('fecha', 'desc')->get();
        return view('pagos.create', compact('reservas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
            'monto' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|in:Yape,Plin,Efectivo,Tarjeta',
            'fecha_pago' => 'required|date',
            'estado' => 'required|in:Pendiente,Pagado,Cancelado',
        ]);

        Pago::create($validated);

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente');
    }

    public function edit(Pago $pago)
    {
        $reservas = Reserva::with('servicio')->orderBy('fecha', 'desc')->get();
        return view('pagos.edit', compact('pago', 'reservas'));
    }

    public function update(Request $request, Pago $pago)
    {
        $validated = $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
            'monto' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|in:Yape,Plin,Efectivo,Tarjeta',
            'fecha_pago' => 'required|date',
            'estado' => 'required|in:Pendiente,Pagado,Cancelado',
        ]);

        $pago->update($validated);

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente');
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente');
    }

    public function export()
    {
        return Excel::download(new PagosExport, 'pagos.xlsx');
    }

    // Métodos para pagos anidados en reservas
    public function createForReserva(Reserva $reserva)
    {
        return view('pagos.create', compact('reserva'));
    }

    public function storeForReserva(Request $request, Reserva $reserva)
    {
        $validated = $request->validate([
            'monto' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|in:Yape,Plin,Efectivo,Tarjeta',
            'fecha_pago' => 'required|date',
            'estado' => 'required|in:Pendiente,Pagado,Cancelado',
        ]);

        $validated['reserva_id'] = $reserva->id;
        Pago::create($validated);

        return redirect()->route('reservas.show', $reserva->id)->with('success', 'Pago registrado correctamente');
    }

    public function show(Pago $pago)
    {
        // Puedes personalizar esto para mostrar detalles de un pago si lo deseas
        return abort(404, 'Página no implementada para pagos individuales');
    }
} 