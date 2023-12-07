<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\Admincontroller;

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
// Esto carga una vista de error 404
Route::fallback(function () {
    return view('error');
});

//  mostrar la pagina de login
Route::get('/login', [Admincontroller::class, 'showlogin']);
//  abrir la session como adminstrador
Route::post('/login', [Admincontroller::class, 'login']);
//  cerrar la session
Route::post('/logout', [Admincontroller::class, 'logout'])->middleware('auth');



// mostrar los viajes disponibles
Route::get('/mostrarViajes', [ViajeController::class, 'mostrarViajes'])->middleware('auth');

// mostrar pagina de modificar
Route::get('/modificar/{id}', [ViajeController::class, 'modificar'])->middleware('auth');

// modificar el viaje 
Route::put('/modificar/{id}', [ViajeController::class, 'update'])->middleware('auth');

//  obtenir informaciones del viaje
Route::get('/mostrarViajes/{id}', [ViajeController::class, 'detalle'])->middleware('auth');

//  eliminar viaje
Route::delete('/mostrarViajes/{id}', [ViajeController::class, 'eliminar'])->middleware('auth');

// mostrar la vista viajes para crear viajes sin pasar pon el controlador
Route::get('/crearViaje', function () {
    return view('viajes');
})->middleware('auth');

// crear un viaje
Route::post('/crearViaje', [ViajeController::class, 'crearViaje'])->name('crearViaje')->middleware('auth');

// Para pagina inicial
Route::get('/', [ViajeController::class, 'show'])->name('home');

// Resulatdo de la busqueda
Route::get('/resultado', [ViajeController::class, 'resultado']);

// pagina para rellenar informaciones personales
Route::get('/resultado/{id}/formPersonal', [ViajeController::class, 'formPersonal']);

// pagina final donde muestra las informaciones del billete
Route::post('/resultado/{viaje_id}/formPersonal/billete', [ViajeController::class, 'billete']);

// descargar el billete de la reservacion en formato PDF
Route::get('/reservacion/{id}/pdf', [ViajeController::class, 'descargarPDF'])->name('descargar_pdf');

// obtenir informaciones de un billete con dni
Route::get('/confirmacion/{dni}', [ViajeController::class, 'confirmacion']);

// mostrar reservas de un viaje:
Route::get('/mostrarReservas/{viaje_id}', [ViajeController::class, 'mostrarResarva'])->middleware('auth');

// obtenir informaciones de una reserva
Route::get('/showReserva', [ViajeController::class, 'showReserva'])->middleware('auth');

// eliminar una reserva
Route::delete('/eliminarReserva/{id}/{viaje_id}', [ViajeController::class, 'eliminarReserva'])->middleware('auth');

// actualizar informaciones de una reserva
Route::post('/modificarReserva', [ViajeController::class, 'modificarReserva'])->middleware('auth');