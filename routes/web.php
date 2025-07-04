<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PagoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ReservaController::class, 'showForm'])->name('reservar.form');

Route::post('/reservar', [ReservaController::class, 'store'])->name('reservar.store');
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::get('/reservas/{reserva}', [ReservaController::class, 'show'])->name('reservas.show');
Route::get('/reservas/{reserva}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
Route::get('/reservas/export', [ReservaController::class, 'export'])->name('reservas.export');

Route::resource('servicios', ServicioController::class);
Route::get('/servicios/export', [ServicioController::class, 'export'])->name('servicios.export');

// Rutas para pagos
Route::get('/pagos/export', [PagoController::class, 'export'])->name('pagos.export');
Route::resource('pagos', PagoController::class);

// Rutas anidadas para pagos de reservas específicas
Route::get('/reservas/{reserva}/pagos/create', [PagoController::class, 'createForReserva'])->name('reservas.pagos.create');
Route::post('/reservas/{reserva}/pagos', [PagoController::class, 'storeForReserva'])->name('reservas.pagos.store');
