@extends('layouts.main')
@section('title')
    Pacientes
@stop

@section('content')
<div class="pt-2" x-data="{ open: false }">
    <div class="flex mb-4">
        <div class="w-1/5 bg-white shadow-md rounded-lg p-4 mr-2">
            <div class="flex items-center mb-4">
                <div class="bg-blue-500 rounded-full p-2">
                    <img src="{{url('/img/card-left.png')}}" alt="Icono" class="h-6 w-6">
                </div>
                <div class="ml-2">
                    <p class="text-lg text-gray-800 font-bold">{{$numerito}}</p>
                    <p class="text-sm text-gray-600">Total de pacientes</p>
                </div>
            </div>
            
        </div>

        <div class="w-1/3 bg-white shadow-md rounded-lg p-4 ml-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-pink-500 rounded-full p-2">
                        <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17h2v-2h-2v2zm0-4h2v-5h-2v5zm0-7.99C11 5.92 11.92 5 13 5s2 .92 2 2.01S14.08 9 13 9s-2-.92-2-2.01zm-1 3.39l-.72.72-.69-.72-1.39 1.39.69.72.72-.72.71.72 1.39-1.39-.71-.72-.72.72z"/>
                        </svg>
                    </div>
                    <div class="ml-2">
                        <p class="text-lg text-gray-800 font-bold">{{$porcentajeM}}%</p>
                        <p class="text-sm text-gray-600">Mujeres</p>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <div class="bg-blue-500 rounded-full p-2">
                        <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14v-4H8v4H5v-6h5V8h2v6h5v6h-3v-4h-2v4h-3z"/>
                        </svg>
                    </div>
                    <div class="ml-2">
                        <p class="text-lg text-gray-800 font-bold">{{$porcentajeH}}%</p>
                        <p class="text-sm text-gray-600">Hombres</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-gray-600 rounded-full p-2">
                        <svg class="fill-current text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14v-4H8v4H5v-6h5V8h2v6h5v6h-3v-4h-2v4h-3z"/>
                        </svg>
                    </div>
                    <div class="ml-2">
                        <p class="text-lg text-gray-800 font-bold">{{$porcentajeO}}%</p>
                        <p class="text-sm text-gray-600">Otros</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="grid grid-cols-10">
            <div class="col-span-2 mb-4 text-right">
                {{$pacientes->links()}}
            </div>
            <div class="col-span-6"></div>
            <div class="col-span-2 text-right">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="open = true">Registrar Paciente</button>
            </div>
        </div>
        <table class="table-auto">
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
                @forelse($pacientes as $paciente)
                    <tr>
                        <td class="border px-4 py-2">{{$paciente->nombre}} {{$paciente->apellido}}</td>
                        <td class="border px-4 py-2">{{$paciente->edad}}</td>
                        <td class="border px-4 py-2">
                            {{ $paciente->sexo == 0 ? 'Masculino' : ($paciente->sexo == 1 ? 'Femenino' : 'Otro') }}
                        </td>                        
                        <td class="border px-4 py-2">{{$paciente->telefono}}</td>
                        <td class="border px-4 py-2">{{$paciente->email}}</td>
                        <td class="border px-4 py-2">{{$paciente->ultima_consulta}}</td>
                        <td class="border px-4 py-2">{{$paciente->siguiente_consulta}}</td>
                        <td class="border px-4 py-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="border px-4 py-2 text-center">No hay pacientes registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
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
                                Registrar Paciente
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('pacientes.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                                            Nombre
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" name="nombre" type="text" placeholder="Nombre del paciente">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="apellido">
                                            Apellido
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="apellido" name="apellido" type="text" placeholder="Apellido del paciente">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_nac">
                                            Fecha de Nacimiento
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha_nac" name="fecha_nac" type="date" onchange="edadUpdate();">
                                    </div>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="edad" name="edad" type="number" placeholder="Edad del paciente" style="display: none">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="sexo">
                                            Sexo
                                        </label>
                                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sexo" name="sexo">
                                            <option value="0">Masculino</option>
                                            <option value="1">Femenino</option>
                                            <option value="2">Otro</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">
                                            Teléfono
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" name="telefono" type="text" placeholder="Teléfono del paciente">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                            Email
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Email del paciente">
                                    </div>
                                    <div class="mt-4 flex justify-end">
                                        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2" @click="open = false">Cancelar</button>                                        
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Registrar</button>
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

<script>
    function edadUpdate(){
        var fecha = document.getElementById("fecha_nac").value;
        var edadElement = document.getElementById("edad");
        var nacimiento = new Date(fecha);
        edadElement.value = ~~ ((Date.now() - nacimiento) / (31557600000));
    }
</script>

@endsection
