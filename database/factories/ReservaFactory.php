<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Servicio;

class ReservaFactory extends Factory
{
    protected $model = \App\Models\Reserva::class;

    public function definition()
    {
        $numero = '+51 9' . $this->faker->unique()->numberBetween(10000000, 99999999);
        return [
            'nombre' => $this->faker->name(),
            'contacto' => $numero,
            'fecha' => $this->faker->date(),
            'hora' => $this->faker->time('H:i'),
            'servicio_id' => Servicio::inRandomOrder()->first()->id ?? 1,
        ];
    }
} 