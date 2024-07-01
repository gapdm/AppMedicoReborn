<?php

namespace App\Http\Controllers;

use App\Models\User;
    
class MedicoController extends Controller{
    public function index(){
        $medicos = User::where('rol',1)->paginate(10);
        return view('medicos', compact('medicos'));
    }
}