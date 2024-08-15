<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('loginForm');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/agenda', [CitaController::class, 'indexAgenda'])->name('agenda')->middleware('auth');
Route::post('/agenda', [CitaController::class, 'storeAgenda'])->name('agenda.store')->middleware('auth');

Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios')->middleware('auth');
Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store')->middleware('auth');
Route::get('/servicios/{id}/edit', [ServicioController::class, 'edit'])->name('servicios.edit')->middleware('auth');
Route::put('/servicios/{id}', [ServicioController::class, 'update'])->name('servicios.update')->middleware('auth');
Route::delete('/servicios/{id}', [ServicioController::class, 'destroy'])->name('servicios.destroy')->middleware('auth');


Route::get('/ventas', [VentaController::class, 'index'])->name('ventas')->middleware('auth');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store')->middleware('auth');
Route::get('/ventas/{id}', [VentaController::class, 'detalles'])->name('ventas.detalles')->middleware('auth');
Route::get('/ventas/{id}', [VentaController::class, 'edit'])->name('ventas.edit')->middleware('auth');
Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update')->middleware('auth');
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy')->middleware('auth');


Route::get('/citas', [CitaController::class, 'indexCitas'] )->name('citas')->middleware('auth');
Route::post('/citas', [CitaController::class, 'storeCitas'])->name('citas.store')->middleware('auth');
Route::get('/citas/{id}', [CitaController::class, 'detalles'])->name('citas.detalles');
Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy')->middleware('auth');
Route::get('citas/{id}/export-pdf', [CitaController::class, 'exportPdf'])->name('citas.export-pdf');


Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos')->middleware('auth');
Route::delete('/medico/{id}', [MedicoController::class, 'destroy'])->name('medicos.destroy');


Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes')->middleware('auth');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store')->middleware('auth');
Route::put('/pacientes/{id}', [PacienteController::class, 'update'])->name('pacientes.update')->middleware('auth');
Route::delete('/pacientes/{id}', [PacienteController::class, 'destroy'])->name('pacientes.destroy')->middleware('auth');