<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            \Database\Seeders\ServicioSeeder::class,
        ]);

        // Seeder personalizado para dashboard
        \App\Models\Pago::query()->delete();
        \App\Models\Reserva::query()->delete();
        \App\Models\Servicio::query()->delete();
        // Servicios reales de barbería
        $serviciosData = [
            ['nombre' => 'Corte de Cabello', 'precio' => 20, 'duracion' => 30],
            ['nombre' => 'Barba y Perfilado', 'precio' => 18, 'duracion' => 25],
            ['nombre' => 'Corte + Barba', 'precio' => 35, 'duracion' => 50],
            ['nombre' => 'Tinte o Coloración', 'precio' => 40, 'duracion' => 60],
            ['nombre' => 'Tratamiento Capilar', 'precio' => 25, 'duracion' => 30],
        ];
        foreach ($serviciosData as $servicio) {
            \App\Models\Servicio::create($servicio);
        }
        $servicios = \App\Models\Servicio::all();
        $metodos = ['Efectivo', 'Yape', 'Plin', 'Tarjeta'];
        $estados = array_merge(
            array_fill(0, 25, 'pagado'),
            array_fill(0, 22, 'pendiente'),
            array_fill(0, 3, 'cancelado')
        );
        shuffle($estados);
        $faker = \Faker\Factory::create('es_PE');
        $hoy = now();
        for ($i = 0; $i < 50; $i++) {
            $fecha = $hoy->copy()->subDays(rand(0, 6));
            $hora = sprintf('%02d:%02d:00', rand(10, 21), collect([0, 15, 30, 45])->random());
            $servicio = $servicios->random();
            $nombre = preg_replace('/[^A-Za-z ]/', '', $faker->firstName);
            $apellido = preg_replace('/[^A-Za-z]/', '', substr($faker->lastName, 0, 7));
            $reserva = \App\Models\Reserva::create([
                'nombre' => $nombre . ' ' . $apellido,
                'contacto' => '9' . $faker->unique()->numberBetween(10000000, 99999999),
                'fecha' => $fecha->format('Y-m-d'),
                'hora' => $hora,
                'servicio_id' => $servicio->id,
            ]);
            $estado = $estados[$i];
            $monto = $servicio->precio;
            $metodo = collect($metodos)->random();
            \App\Models\Pago::create([
                'reserva_id' => $reserva->id,
                'monto' => $monto,
                'metodo_pago' => $metodo,
                'fecha_pago' => $fecha->format('Y-m-d'),
                'estado' => $estado,
            ]);
        }
    }
}
