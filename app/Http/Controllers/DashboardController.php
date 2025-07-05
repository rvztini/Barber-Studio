<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Servicio;
use App\Models\Reserva;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ingresos últimos 7 días
        $dias = collect(range(0, 6))->map(function ($i) {
            return now()->subDays(6 - $i)->format('Y-m-d');
        });
        $ingresos = $dias->map(function ($dia) {
            return [
                'fecha' => $dia,
                'total' => Pago::whereDate('fecha_pago', $dia)->where('estado', 'Pagado')->sum('monto'),
            ];
        });

        // Métodos de pago usados
        $metodos = ['Efectivo', 'Yape', 'Plin', 'Tarjeta'];
        $metodos_pago = collect($metodos)->mapWithKeys(function ($metodo) {
            return [$metodo => Pago::where('metodo_pago', $metodo)->count()];
        });

        // Top 5 servicios más reservados
        $top_servicios = Servicio::select('servicios.nombre', DB::raw('COUNT(reservas.id) as total'))
            ->leftJoin('reservas', 'servicios.id', '=', 'reservas.servicio_id')
            ->groupBy('servicios.id', 'servicios.nombre')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('dashboard', [
            'ingresos' => $ingresos,
            'metodos_pago' => $metodos_pago,
            'top_servicios' => $top_servicios,
        ]);
    }
} 