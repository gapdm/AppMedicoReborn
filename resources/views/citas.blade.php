@extends('layouts.main')

@section('title')
    Citas
@stop
@section('content')
<div class="p-2">
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="mt-4 mb-4 items-end">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="openModal()">Registrar Cita</button>
        </div>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Paciente</th>
                    <th class="px-4 py-2">Medico</th>
                    <th class="px-4 py-2">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2"><a href="{{route('citas/1')}}" class="text-purple-500 hover:text-purple-400">1</a></td>
                    <td class="border px-4 py-2">John Doe</td>
                    <td class="border px-4 py-2">John Doector</td>
                    <td class="border px-4 py-2">11-07-2024</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
