@extends('layouts.main')

@section('title')
    Medicos
@stop

@section('content')
<div class="p-2">
    <div class="bg-white shadow-md rounded-lg p-4">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Paciente</th>
                    <th class="px-4 py-2">Sexo</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Cedula Profesional</th>
                    <th class="px-4 py-2">Especialidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicos as $medico)
                    <tr>
                        <td class="border px-4 py-2">{{ $medico->nombre }} {{ $medico->apellido }}</td>
                        <td class="border px-4 py-2">{{ $medico->sexo }}</td>
                        <td class="border px-4 py-2">{{ $medico->telefono }}</td>
                        <td class="border px-4 py-2">{{ $medico->email }}</td>
                        <td class="border px-4 py-2">{{ $medico->cedula }}</td>
                        <td class="border px-4 py-2">{{ $medico->especialidad }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center">No hay médicos disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Enlaces de paginación -->
        <div class="mt-4">
            {{ $medicos->links() }}
        </div>
    </div>
</div>
@endsection
