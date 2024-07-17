<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/citas', [CitaController::class, 'indexCitas'] )->name('citas')->middleware('auth');
Route::post('/citas', [CitaController::class, 'storeCitas'])->name('citas.store')->middleware('auth');
Route::get('/citas/{id}', [CitaController::class, 'detalles'])->name('citas.detalles')->middleware('auth');
Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');



Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos')->middleware('auth');

Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes')->middleware('auth');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store')->middleware('auth');