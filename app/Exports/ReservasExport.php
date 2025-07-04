<?php

namespace App\Exports;

use App\Models\Reserva;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Reserva::with('servicio')->get()->map(function ($reserva) {
            return [
                'ID' => $reserva->id,
                'Nombre' => $reserva->nombre,
                'Contacto' => $reserva->contacto,
                'Fecha' => $reserva->fecha,
                'Hora' => $reserva->hora,
                'Servicio' => $reserva->servicio ? $reserva->servicio->nombre : '',
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Contacto', 'Fecha', 'Hora', 'Servicio'];
    }
}
