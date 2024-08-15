<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::simplePaginate(5);
        $numerito = Paciente::count();
        $hombres = Paciente::where('sexo', 0)->count();
        $mujeres = Paciente::where('sexo', 1)->count();
        $otros = Paciente::where('sexo', 2)->count();

        $porcentajeH = number_format(($hombres / $numerito) * 100, 0);
        $porcentajeM = number_format(($mujeres / $numerito) * 100, 0);
        $porcentajeO = number_format(($otros / $numerito) * 100, 0);

        if (($porcentajeH + $porcentajeM + $porcentajeO) < 100) {
            $porcentajeH += 1;
        }

        return view('pacientes', compact('pacientes', 'numerito', 'porcentajeH', 'porcentajeM', 'porcentajeO'));
    }

    public function store(Request $request)
    {
        Log::debug($request);

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nac' => 'required|date',
            'edad' => 'required|integer',
            'sexo' => 'required|integer',
            'telefono' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        Log::debug("Validación pasada, creando paciente");

        Paciente::create($validatedData);

        Log::debug("Paciente creado");

        return redirect()->route('pacientes')->with('success', 'Paciente registrado con éxito');
    }

    public function update(Request $request, $id)
    {
        Log::debug("Actualizando paciente con ID: $id");

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nac' => 'required|date',
            'edad' => 'required|integer',
            'sexo' => 'required|integer',
            'telefono' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $paciente = Paciente::findOrFail($id);
        $paciente->update($validatedData);

        Log::debug("Paciente actualizado");

        return redirect()->route('pacientes')->with('success', 'Paciente actualizado con éxito');
    }

    public function destroy($id)
    {
        Log::debug("Eliminando paciente con ID: $id");

        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        Log::debug("Paciente eliminado");

        return redirect()->route('pacientes')->with('success', 'Paciente eliminado con éxito');
    }
}
