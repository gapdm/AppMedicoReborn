@extends('layouts.main')

@section('title')
    Medicos
@stop

@section('content')
<div class="p-2">
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="mb-4">
            {{$medicos->links()}}
        </div>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Medico</th>
                    <th class="px-4 py-2">Sexo</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Cedula Profesional</th>
                    <th class="px-4 py-2">Especialidad</th>
                    @if (Auth::user()->rol==2)
                    <th class="px-4 py-2">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($medicos as $medico)
                    <tr>
                        <td class="border px-4 py-2">{{ $medico->nombre }} {{ $medico->apellido }}</td>
                        <td class="border px-4 py-2">
                            {{ $medico->sexo == 0 ? 'Masculino' : ($medico->sexo == 1 ? 'Femenino' : 'Otro') }}
                        </td>
                        <td class="border px-4 py-2">{{ $medico->telefono }}</td>
                        <td class="border px-4 py-2">{{ $medico->email }}</td>
                        <td class="border px-4 py-2">{{ $medico->cedula }}</td>
                        <td class="border px-4 py-2">{{ $medico->especialidad }}</td>
                        @if (Auth::user()->rol==2)
                        <td class="border px-4 py-2">
                            <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" x-data="{ open: false }" x-on:submit="open = false" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Eliminar</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center">No hay médicos disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
