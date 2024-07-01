<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
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

Route::get('/agenda', function () {
    return view('agenda');
})->name('agenda')->middleware('auth');

Route::get('/citas', function () {
    return view('citas');
})->name('citas')->middleware('auth');

Route::get('/citas/1', function () {
    return view('citasDetalles');
})->name('citas/1')->middleware('auth');

Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos')->middleware('auth');

Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes')->middleware('auth');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store')->middleware('auth');