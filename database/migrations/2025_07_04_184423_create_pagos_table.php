<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_id')->constrained('reservas')->onDelete('cascade');
            $table->decimal('monto', 8, 2);
            $table->enum('metodo_pago', ['Yape', 'Plin', 'Efectivo', 'Tarjeta']);
            $table->date('fecha_pago');
            $table->enum('estado', ['Pagado', 'Pendiente', 'Cancelado'])->default('Pagado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
