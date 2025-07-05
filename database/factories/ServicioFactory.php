<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioFactory extends Factory
{
    protected $model = \App\Models\Servicio::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word() . ' ' . $this->faker->randomElement(['Corte', 'Barba', 'Color', 'Peinado']),
            'precio' => $this->faker->randomFloat(2, 10, 100),
            'duracion' => $this->faker->numberBetween(15, 90),
        ];
    }
} 