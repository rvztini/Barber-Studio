<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicios = [
            ['nombre' => 'Corte clásico', 'precio' => 20.00, 'duracion' => 30],
            ['nombre' => 'Corte degradado', 'precio' => 25.00, 'duracion' => 35],
            ['nombre' => 'Corte + barba', 'precio' => 35.00, 'duracion' => 45],
            ['nombre' => 'Perfilado de barba', 'precio' => 15.00, 'duracion' => 20],
            ['nombre' => 'Afeitado tradicional', 'precio' => 18.00, 'duracion' => 25],
            ['nombre' => 'Diseño de cejas', 'precio' => 10.00, 'duracion' => 10],
            ['nombre' => 'Tinte para barba', 'precio' => 22.00, 'duracion' => 20],
            ['nombre' => 'Tinte para cabello', 'precio' => 30.00, 'duracion' => 40],
            ['nombre' => 'Limpieza facial', 'precio' => 28.00, 'duracion' => 30],
            ['nombre' => 'Alisado de cabello', 'precio' => 40.00, 'duracion' => 60],
            ['nombre' => 'Mascarilla facial', 'precio' => 15.00, 'duracion' => 15],
            ['nombre' => 'Peinado', 'precio' => 12.00, 'duracion' => 15],
            ['nombre' => 'Corte para niño', 'precio' => 15.00, 'duracion' => 25],
            ['nombre' => 'Tratamiento capilar', 'precio' => 35.00, 'duracion' => 40],
        ];
        foreach ($servicios as $servicio) {
            \App\Models\Servicio::create($servicio);
        }
    }
}
