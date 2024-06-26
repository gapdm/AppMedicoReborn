@extends('layouts.main')

@section('title')
    Cita 1
@stop

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Detalles de la Cita Médica</h2>
    <form>
        <div class="mb-4">
            <label for="fecha" class="block text-gray-700">Fecha</label>
            <input type="text" id="fecha" name="fecha" value="2024-06-25" disabled class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="paciente" class="block text-gray-700">Paciente</label>
            <input type="text" id="paciente" name="paciente" value="Nombre del Paciente" disabled class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="medico" class="block text-gray-700">Médico</label>
            <input type="text" id="medico" name="medico" value="Nombre del Médico" disabled class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <h3 class="text-lg font-medium mb-4">Datos de la Cita</h3>

        <div class="mb-4">
            <label for="estatura" class="block text-gray-700">Estatura</label>
            <input type="text" id="estatura" name="estatura" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="peso" class="block text-gray-700">Peso</label>
            <input type="text" id="peso" name="peso" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="presion" class="block text-gray-700">Presión Arterial</label>
            <input type="text" id="presion" name="presion" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="temperatura" class="block text-gray-700">Temperatura</label>
            <input type="text" id="temperatura" name="temperatura" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
