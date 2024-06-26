<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{
    public function index(){
        $medicos = User::where('rol',1)->paginate(10);
        return view('medicos', compact('medicos'));
    }
}