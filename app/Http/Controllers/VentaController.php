<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Servicio;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    // Muestra una lista de todas las ventas.
    public function index() {
        $ventas = Venta::with(['paciente', 'medico', 'servicios'])->get();
        $medicos = User::where('rol', 1)->paginate(10);
        $pacientes = Paciente::get();
        $servicios = Servicio::get();
    
        return view('ventas', compact('ventas', 'medicos', 'pacientes', 'servicios'));
    }

    // Almacena una nueva venta en la base de datos.
    public function store(Request $request) {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'servicios' => 'required|array',
            'servicios.*' => 'exists:servicios,id',
            'total' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            // Crear la venta.
            $venta = Venta::create([
                'paciente_id' => $request->paciente_id,
                'medico_id' => $request->medico_id,
                'total' => $request->total,
            ]);

            // Adjuntar servicios a la venta.
            $servicios = $request->input('servicios', []);
            foreach ($servicios as $servicioId) {
                $venta->servicios()->attach($servicioId);
            }
        });

        return redirect()->route('ventas')->with('success', 'Venta registrada con éxito.');
    }
    public function detalles($id)
    {
        $venta = Venta::with('paciente', 'medico', 'servicios')->findOrFail($id);
        return view('ventaDetalles', compact('venta'));
    }

    // Muestra el formulario para editar una venta existente.
    public function edit($id) {
        $venta = Venta::with('servicios')->findOrFail($id);
        $medicos = User::where('rol', 1)->get();
        $pacientes = Paciente::get();
        $servicios = Servicio::get();

        return view('ventas.edit', compact('venta', 'medicos', 'pacientes', 'servicios'));
    }

    // Actualiza una venta existente en la base de datos.
    public function update(Request $request, $id) {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'servicios' => 'required|array',
            'servicios.*' => 'exists:servicios,id',
            'total' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $id) {
            $venta = Venta::findOrFail($id);

            // Actualizar la venta.
            $venta->update([
                'paciente_id' => $request->paciente_id,
                'medico_id' => $request->medico_id,
                'total' => $request->total,
            ]);

            // Sincronizar servicios.
            $venta->servicios()->sync($request->input('servicios', []));
        });

        return redirect()->route('ventas')->with('success', 'Venta actualizada con éxito.');
    }

    // Elimina una venta de la base de datos.
    public function destroy($id) {
        $venta = Venta::findOrFail($id);

        $venta->delete();

        return redirect()->route('ventas')->with('success', 'Venta eliminada con éxito.');
    }
}
