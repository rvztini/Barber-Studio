<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'contacto',
        'fecha',
        'hora',
        'servicio_id',
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
