@extends('layouts.main')

@section('title')
    Cita {{ $cita->id }}
@stop

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Detalles de la Cita Médica</h2>
    <form method="POST" action="{{ route('citas.update', ['id' => $cita->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="fecha" class="block text-gray-700">Fecha</label>
            <input type="text" id="fecha" name="fecha" value="{{ $cita->fecha }}" disabled
                class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="paciente" class="block text-gray-700">Paciente</label>
            <input type="text" id="paciente" name="paciente" value="{{ $paciente->nombre }} {{ $paciente->apellido }}" disabled
                class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="medico" class="block text-gray-700">Médico</label>
            <input type="text" id="medico" name="medico" value="{{ $medico->nombre }} {{ $medico->apellido }}" disabled
                class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="motivo_consulta" class="block text-gray-700">Motivo de la Consulta</label>
            <input type="text" id="motivo_consulta" name="motivo_consulta" value="{{ $cita->motivo_consulta }}" disabled
                class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <h3 class="text-lg font-medium mb-4">Datos de la Cita</h3>

        <div class="mb-4">
            <label for="talla" class="block text-gray-700">Estatura</label>
            <input type="text" id="talla" name="talla" value="{{ $cita->talla }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="peso" class="block text-gray-700">Peso</label>
            <input type="text" id="peso" name="peso" value="{{ $cita->peso }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="frecuencia_cardiaca" class="block text-gray-700">Frecuencia Cardiaca</label>
            <input type="text" id="frecuencia_cardiaca" name="frecuencia_cardiaca" value="{{ $cita->frecuencia_cardiaca }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="temperatura" class="block text-gray-700">Temperatura</label>
            <input type="text" id="temperatura" name="temperatura" value="{{ $cita->temperatura }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="notas_padecimiento" class="block text-gray-700">Notas de Padecimiento</label>
            <textarea id="notas_padecimiento" name="notas_padecimiento" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $cita->notas_padecimiento }}</textarea>
        </div>
        <div class="mb-4">
            <label for="estado" class="block text-gray-700">Estado</label>
            <select id="estado" name="estado" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="0" {{ $cita->estado == 0 ? 'selected' : '' }}>Asignada</option>
                <option value="1" {{ $cita->estado == 1 ? 'selected' : '' }}>Empezada</option>
                <option value="2" {{ $cita->estado == 2 ? 'selected' : '' }}>Terminada</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
