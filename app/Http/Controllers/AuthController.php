<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'sexo' => 'required|in:0,1,2',
        'rol' => 'required|in:0,1',
        'password' => 'required|string|min:8',
        'especialidad' => 'nullable|required_if:rol,1|string|max:255',
        'cedula' => 'nullable|required_if:rol,1|string|max:255',
    ],[
        'nombre.required' => 'Nombre es requerido',
        'apellido.required' => 'Apellidos son requeridos',
        'email.required' => 'E-Mail es requerido',
        'password.required' => 'Contraseña es requerida',
        'especialidad.required_if' => 'Especialidad es requerida cuando el rol es Médico',
        'cedula.required_if' => 'Cédula es requerida cuando el rol es Médico',
    ]);

    $user = User::create([
        'nombre' => $validated['nombre'],
        'apellido' => $validated['apellido'],
        'email' => $validated['email'],
        'sexo' => $validated['sexo'],
        'rol' => $validated['rol'],
        'password' => Hash::make($validated['password']),
        'especialidad' => $validated['rol'] == 1 ? $validated['especialidad'] : null,
        'cedula' => $validated['rol'] == 1 ? $validated['cedula'] : null,
    ]);

    Auth::login($user);

    return redirect()->route('agenda');
}


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('agenda');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
