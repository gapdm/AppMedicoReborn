<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Cita;
use App\Models\User;

class CitaController extends Controller
{
    public function indexAgenda(){
        $citas = Cita::get();
        $medicos = User::where('rol',1)->paginate(10);
        $pacientes = Paciente::get();
        return view('agenda', compact('citas','medicos','pacientes'));
    }

    public function storeAgenda(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'motivo_consulta' => 'required|string|max:255',
        ]);

        Cita::create($request->all());

        return redirect()->route('agenda')->with('success', 'Cita registrada exitosamente.');
    }
}
