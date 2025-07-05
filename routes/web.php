<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Servicio;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $servicios = Servicio::all();
    return view('welcome', compact('servicios'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Servicios
    Route::resource('servicios', App\Http\Controllers\ServicioController::class);
    Route::get('servicios-export', [App\Http\Controllers\ServicioController::class, 'export'])->name('servicios.export');

    // CRUD Reservas
    Route::resource('reservas', App\Http\Controllers\ReservaController::class);
    Route::get('reservas-export', [App\Http\Controllers\ReservaController::class, 'export'])->name('reservas.export');
    // Pagos anidados en reservas
    Route::get('reservas/{reserva}/pagos/create', [App\Http\Controllers\PagoController::class, 'createForReserva'])->name('reservas.pagos.create');
    Route::post('reservas/{reserva}/pagos', [App\Http\Controllers\PagoController::class, 'storeForReserva'])->name('reservas.pagos.store');

    // CRUD Pagos
    Route::resource('pagos', App\Http\Controllers\PagoController::class);
    Route::get('pagos-export', [App\Http\Controllers\PagoController::class, 'export'])->name('pagos.export');
});

require __DIR__.'/auth.php';
