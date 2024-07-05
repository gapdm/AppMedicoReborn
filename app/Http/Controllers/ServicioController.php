<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index(){
        $servicios = Servicio::simplePaginate(5);

        return view('servicios', compact('servicios'));
    }

    public function store(Request $request){

         $validatedData = $request->validate([
            'servicio' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'acceso' => 'required|integer',
        ]);

        Servicio::create($validatedData);

        return redirect()->route('servicios')->with('success', 'Paciente registrado con éxito');
    }
}
