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
                    <th class="px-4 py-2">Edad</th>
                    <th class="px-4 py-2">Sexo</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Cedula Profesional</th>
                    <th class="px-4 py-2">Especialidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">John Doe</td>
                    <td class="border px-4 py-2">35</td>
                    <td class="border px-4 py-2">Masculino</td>
                    <td class="border px-4 py-2">1234567890</td>
                    <td class="border px-4 py-2">john.doe@example.com</td>
                    <td class="border px-4 py-2">78548996245662</td>
                    <td class="border px-4 py-2">Corazon</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
