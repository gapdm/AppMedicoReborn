<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PDF;

class CitaController extends Controller
{
    public function detalles($id)
    {
        $cita = Cita::findOrFail($id);
        $paciente = Paciente::findOrFail($cita->paciente_id);
        $medico = User::findOrFail($cita->medico_id);
        return view('citasDetalles', compact('cita','paciente','medico'));
    }

    public function indexAgenda(){
        $citas = Cita::where('estado', '!=', 2)->get();
        $medicos = User::where('rol',1)->paginate(10);
        $pacientes = Paciente::get();
        return view('agenda', compact('citas','medicos','pacientes'));
    }

    public function indexCitas(){
        if (Auth::user()->rol == 2){
            $citas = Cita::get();
        } else {
            $citas = Cita::where('estado', '!=', 2)->get();
        }
        $medicos = User::where('rol', 1)->paginate(10);
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

    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $validatedData = $request->validate([
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

        foreach ($validatedData as $key => $value) {
            $cita->$key = $value;
        }

        $cita->save();

        Log::debug('Cita actualizada manualmente:', $cita->toArray());

        return redirect()->route('citas.detalles', ['id' => $cita->id])->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas')->with('success', 'Cita eliminada exitosamente.');
    }

    public function exportPdf($id)
    {
        $cita = Cita::findOrFail($id);
        $paciente = $cita->paciente;
        $medico = $cita->medico;

        $pdf = PDF::loadView('pdf', compact('cita', 'paciente', 'medico'));
        return $pdf->download('cita_'.$cita->id.'.pdf');
    }
}
