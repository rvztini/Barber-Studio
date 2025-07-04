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
        Servicio::insert([
            [
                'nombre' => 'corte',
                'precio' => 15.00,
                'duracion' => 20,
            ],
            [
                'nombre' => 'barba',
                'precio' => 10.00,
                'duracion' => 15,
            ],
            [
                'nombre' => 'ceja',
                'precio' => 5.00,
                'duracion' => 10,
            ],
        ]);
    }
}
