<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Cita;
use App\Models\User;

class CitaController extends Controller
{

    public function detalles($id)
    {
        $cita = Cita::findOrFail($id);
        $paciente = Paciente::findOrFail($cita->paciente_id);
        $medico = Paciente::findOrFail($cita->medico_id);
        return view('citasDetalles', compact('cita','paciente','medico'));
    }

    public function indexAgenda(){
        $citas = Cita::where('estado', '!=', 2)->get();
        $medicos = User::where('rol',1)->paginate(10);
        $pacientes = Paciente::get();
        return view('agenda', compact('citas','medicos','pacientes'));
    }

    public function indexCitas(){
        $citas = Cita::where('estado', '!=', 2)->get();
        $medicos = User::where('rol',1)->paginate(10);
        $pacientes = Paciente::get();
        return view('citas', compact('citas','medicos','pacientes'));
    }

    public function storeAgenda(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'motivo_consulta' => 'nullable|string|max:255',
        ]);

        Cita::create($request->all());

        return redirect()->route('agenda')->with('success', 'Cita registrada exitosamente.');
    }

    public function storeCitas(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'motivo_consulta' => 'nullable|string|max:255',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas')->with('success', 'Cita registrada exitosamente.');
    }

    public function update(Request $request, Cita $cita)
    {
        
        $request->validate([
            'talla' => 'nullable|numeric',
            'temperatura' => 'nullable|numeric',
            'saturacion_oxigeno' => 'nullable|integer',
            'frecuencia_cardiaca' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'motivo_consulta' => 'nullable|string|max:255',
            'notas_padecimiento' => 'nullable|string|max:255',
            'estado' => 'nullable|integer|between:0,2',
            'fecha' => 'nullable|date',
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.detalles', ['id' => $cita->id])->with('success', 'Cita actualizada correctamente.');
    }
}
