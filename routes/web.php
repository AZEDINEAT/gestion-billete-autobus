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


Route::get('/login', [Admincontroller::class, 'showlogin']);
Route::post('/login', [Admincontroller::class, 'login']);
Route::post('/logout', [Admincontroller::class, 'logout'])->middleware('auth');

Route::get('/crearViaje', function () {
    return view('viajes');
})->middleware('auth');

Route::get('/modificar/{id}', [ViajeController::class, 'modificar'])->middleware('auth');
Route::put('/modificar/{id}', [ViajeController::class, 'update'])->middleware('auth');


Route::get('/mostrarViajes/{id}', [ViajeController::class, 'detalle'])->middleware('auth');
Route::get('/mostrarViajes', [ViajeController::class, 'mostrarViajes'])->middleware('auth');
Route::delete('/mostrarViajes/{id}', [ViajeController::class, 'eliminar'])->middleware('auth');


Route::post('/crearViaje', [ViajeController::class, 'crearViaje'])->name('crearViaje')->middleware('auth');


Route::get('/', [ViajeController::class, 'show'])->name('home');

Route::get('/resultado', [ViajeController::class, 'resultado']);
Route::get('/resultado/{id}/profil', [ViajeController::class, 'profil']);
Route::post('/resultado/{viaje_id}/profil/ticket', [ViajeController::class, 'guardarReservacion']);
Route::get('/reservacion/{id}/pdf', [ViajeController::class, 'descargarPDF'])->name('descargar_pdf');


Route::get('/confirmacion/{dni}', [ViajeController::class, 'confirmacion']);


Route::get('/mostrarReservas/{viaje_id}', [ViajeController::class, 'mostrarResarva']);