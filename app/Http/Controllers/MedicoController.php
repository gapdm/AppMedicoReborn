<?php

namespace App\Http\Controllers;

use App\Models\User;
    
class MedicoController extends Controller{
    public function index(){
        $medicos = User::where('rol',1)->paginate(10);
        return view('medicos', compact('medicos'));
    }
    public function destroy($id)
    {
        $medico = User::findOrFail($id);
        $medico->delete();
        return redirect()->route('medicos')->with('success', 'Médico eliminado con éxito.');
    }
}