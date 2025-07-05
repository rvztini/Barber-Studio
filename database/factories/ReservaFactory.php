<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Servicio;

class ReservaFactory extends Factory
{
    protected $model = \App\Models\Reserva::class;

    public function definition()
    {
        $nombre = $this->faker->firstName();
        $apellido = $this->faker->lastName();
        // Si el apellido es muy largo, usar solo los primeros 7 caracteres
        if (strlen($apellido) > 7) {
            $apellido = substr($apellido, 0, 7);
        }
        $nombreCompleto = $nombre . ' ' . $apellido;
        $numero = '9' . $this->faker->unique()->numberBetween(10000000, 99999999);
        // Horarios permitidos
        $horasManana = ['10', '11', '12'];
        $horasTarde = ['13', '14', '15', '16', '17', '18', '19', '20', '21', '22'];
        $minutos = ['00', '15', '30', '45'];
        $turno = $this->faker->randomElement(['manana', 'tarde']);
        if ($turno === 'manana') {
            $hora = $this->faker->randomElement($horasManana);
            $min = $this->faker->randomElement($minutos);
            // Evitar 12:30 y 12:45 (almuerzo)
            if ($hora === '12' && in_array($min, ['30', '45'])) {
                $min = '00';
            }
            $horaCompleta = $hora . ':' . $min . ':00';
        } else {
            $hora = $this->faker->randomElement($horasTarde);
            $min = $this->faker->randomElement($minutos);
            // Evitar 13:00 y 13:15 (almuerzo)
            if ($hora === '13' && in_array($min, ['00', '15'])) {
                $min = '30';
            }
            $horaCompleta = $hora . ':' . $min . ':00';
        }
        return [
            'nombre' => $nombreCompleto,
            'contacto' => $numero,
            'fecha' => '2025-07-05',
            'hora' => $horaCompleta,
            'servicio_id' => Servicio::inRandomOrder()->first()->id ?? 1,
        ];
    }
} 