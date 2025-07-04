<?php

namespace App\Exports;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PagosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pago::with('reserva.servicio')->get()->map(function ($pago) {
            return [
                'ID' => $pago->id,
                'Cliente' => $pago->reserva ? $pago->reserva->nombre : '',
                'Contacto' => $pago->reserva ? $pago->reserva->contacto : '',
                'Servicio' => $pago->reserva && $pago->reserva->servicio ? $pago->reserva->servicio->nombre : '',
                'Monto' => 'S/ ' . number_format($pago->monto, 2),
                'Método de Pago' => $pago->metodo_pago,
                'Fecha de Pago' => $pago->fecha_pago,
                'Estado' => $pago->estado,
                'Fecha de Reserva' => $pago->reserva ? $pago->reserva->fecha : '',
                'Hora de Reserva' => $pago->reserva ? $pago->reserva->hora : '',
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Cliente', 'Contacto', 'Servicio', 'Monto', 'Método de Pago', 'Fecha de Pago', 'Estado', 'Fecha de Reserva', 'Hora de Reserva'];
    }
} 