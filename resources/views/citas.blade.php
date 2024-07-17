@extends('layouts.main')

@section('title')
    Citas
@stop
@section('content')
<div class="p-2"  x-data="{ open: false }">
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="mt-4 mb-4 items-end">
            <button @click="open = true" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Registrar Cita
            </button>
        </div>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Paciente</th>
                    <th class="px-4 py-2">Medico</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td class="border px-4 py-2"><a href="{{ route('citas.detalles', ['id' => $cita->id]) }}" class="text-purple-500 hover:text-purple-400">{{$cita->id}}</a></td>
                    <td class="border px-4 py-2">
                        @php
                            $paciente = $pacientes->firstWhere('id', $cita->paciente_id);
                        @endphp
                        {{ $paciente->nombre }} {{ $paciente->apellido }}
                    </td>
                    <td class="border px-4 py-2">
                        @php
                            $medico = $medicos->firstWhere('id', $cita->medico_id);
                        @endphp
                        {{ $medico->nombre }} {{ $medico->apellido }}
                    </td>
                    <td class="border px-4 py-2">{{$cita->fecha}}</td>
                    <td class="border px-4 py-2">{{$cita->estado}}</td>
                    <td class="border px-4 py-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">No hay médicos disponibles</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Registrar Nueva Cita
                            </h3>
                            <div class="mt-2">
                                <form action="{{route('citas.store')}}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="paciente_id" class="block text-gray-700">Paciente</label>
                                        <select name="paciente_id" id="paciente_id" class="w-full border border-gray-300 p-2 rounded-lg">
                                            @foreach($pacientes as $paciente)
                                                <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="medico_id" class="block text-gray-700">Médico</label>
                                        <select name="medico_id" id="medico_id" class="w-full border border-gray-300 p-2 rounded-lg">
                                            @foreach($medicos as $medico)
                                                <option value="{{ $medico->id }}">{{ $medico->nombre }} {{ $medico->apellido }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="fecha" class="block text-gray-700">Fecha</label>
                                        <input type="datetime-local" name="fecha" id="fecha" class="w-full border border-gray-300 p-2 rounded-lg">
                                    </div>
                                    <div class="mb-4">
                                        <label for="motivo_consulta" class="block text-gray-700">Motivo de Consulta</label>
                                        <textarea name="motivo_consulta" id="motivo_consulta" class="w-full border border-gray-300 p-2 rounded-lg"></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" @click="open = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
