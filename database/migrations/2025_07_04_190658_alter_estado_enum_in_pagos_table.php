<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // MySQL no permite modificar ENUM fácilmente, así que se usa SQL directo
        DB::statement("ALTER TABLE pagos MODIFY estado ENUM('Pagado', 'Pendiente', 'Cancelado') DEFAULT 'Pagado'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE pagos MODIFY estado ENUM('Pagado', 'Pendiente') DEFAULT 'Pagado'");
    }
};
