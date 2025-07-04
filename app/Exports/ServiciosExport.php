<?php

namespace App\Exports;

use App\Models\Servicio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiciosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Servicio::all()->map(function ($servicio) {
            return [
                'ID' => $servicio->id,
                'Nombre' => $servicio->nombre,
                'Precio (S/)' => 'S/ ' . number_format($servicio->precio, 2),
                'Duración (min)' => $servicio->duracion,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Precio (S/)', 'Duración (min)'];
    }
}
