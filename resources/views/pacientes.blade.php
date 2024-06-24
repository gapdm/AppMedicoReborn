@extends('layouts.main')
@section('title')
    Pacientes
@stop

@section('content')
<div class="p-6">
    <div class="flex mb-4">
        <!-- Tarjeta 1: Total de pacientes -->
        <div class="w-1/6 bg-white shadow-md rounded-lg p-4 mr-2">
            <div class="flex items-center mb-4">
                <div class="bg-blue-500 rounded-full p-2">
                    <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3 14H9v-2h6v2zm0-4H9V8h6v4z"/>
                    </svg>
                </div>
                <div class="ml-2">
                    <p class="text-lg text-gray-800 font-bold">123</p>
                    <p class="text-sm text-gray-600">Total de pacientes</p>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2: Estadísticas por género -->
        <div class="w-1/6 bg-white shadow-md rounded-lg p-4 ml-2">
            <div class="flex items-center justify-between">
                <!-- Mujeres -->
                <div class="flex items-center">
                    <div class="bg-pink-500 rounded-full p-2">
                        <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17h2v-2h-2v2zm0-4h2v-5h-2v5zm0-7.99C11 5.92 11.92 5 13 5s2 .92 2 2.01S14.08 9 13 9s-2-.92-2-2.01zm-1 3.39l-.72.72-.69-.72-1.39 1.39.69.72.72-.72.71.72 1.39-1.39-.71-.72-.72.72z"/>
                        </svg>
                    </div>
                    <div class="ml-2">
                        <p class="text-lg text-gray-800 font-bold">45%</p>
                        <p class="text-sm text-gray-600">Mujeres</p>
                    </div>
                </div>
                
                <!-- Hombres -->
                <div class="flex items-center">
                    <div class="bg-blue-500 rounded-full p-2">
                        <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14v-4H8v4H5v-6h5V8h2v6h5v6h-3v-4h-2v4h-3z"/>
                        </svg>
                    </div>
                    <div class="ml-2">
                        <p class="text-lg text-gray-800 font-bold">55%</p>
                        <p class="text-sm text-gray-600">Hombres</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de pacientes -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="mt-4 mb-4 items-end">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="openModal()">Registrar Paciente</button>
        </div>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Paciente</th>
                    <th class="px-4 py-2">Edad</th>
                    <th class="px-4 py-2">Sexo</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Última Consulta</th>
                    <th class="px-4 py-2">Siguiente Consulta</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irían los datos de los pacientes, puedes iterar sobre una colección de Laravel -->
                <tr>
                    <td class="border px-4 py-2">John Doe</td>
                    <td class="border px-4 py-2">35</td>
                    <td class="border px-4 py-2">Masculino</td>
                    <td class="border px-4 py-2">1234567890</td>
                    <td class="border px-4 py-2">john.doe@example.com</td>
                    <td class="border px-4 py-2">2023-01-15</td>
                    <td class="border px-4 py-2">2023-07-15</td>
                    <td class="border px-4 py-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
