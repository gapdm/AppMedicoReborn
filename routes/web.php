<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('loginForm');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Ruta para procesar el formulario de registro
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Ruta para procesar el formulario de inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Ruta para redirigir después del registro o inicio de sesión
Route::get('/agenda', function () {
    return view('agenda');
})->name('agenda')->middleware('auth');

Route::get('/pacientes', function () {
    return view('pacientes');
})->name('pacientes')->middleware('auth');

Route::get('/citas', function () {
    return view('citas');
})->name('citas')->middleware('auth');

Route::get('/citas/1', function () {
    return view('citasDetalles');
})->name('citas/1')->middleware('auth');

Route::get('/medicos', function () {
    return view('medicos');
})->name('medicos')->middleware('auth');