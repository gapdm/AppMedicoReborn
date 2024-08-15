@extends('layouts.main')
@section('title')
    Pacientes
@stop

@section('content')
<div class="pt-2" x-data="{ open: false, editMode: false, currentPaciente: {} }">
    <div class="flex mb-4">
        <!-- Aquí irían tus estadísticas, no las modifiqué -->
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="grid grid-cols-10">
            <div class="col-span-2 mb-4 text-right">
                {{$pacientes->links()}}
            </div>
            <div class="col-span-6"></div>
            <div class="col-span-2 text-right">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="editMode = false; currentPaciente = {}; open = true">Registrar Paciente</button>
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
                        <td class="border px-4 py-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="editMode = true; currentPaciente = {{ $paciente }}; open = true">Editar</button>
                            @if (Auth::user()->rol!=0)
                            <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Eliminar</button>
                            </form>
                            @endif
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
                                <span x-show="!editMode">Registrar Paciente</span>
                                <span x-show="editMode">Editar Paciente</span>
                            </h3>
                            <div class="mt-2">
                                <form :action="editMode ? `{{ url('pacientes') }}/${currentPaciente.id}` : '{{ route('pacientes.store') }}'" method="POST">
                                    @csrf
                                    <template x-if="editMode">
                                        <input type="hidden" name="_method" value="PUT">
                                    </template>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                                            Nombre
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" name="nombre" type="text" placeholder="Nombre del paciente" x-model="currentPaciente.nombre">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="apellido">
                                            Apellido
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="apellido" name="apellido" type="text" placeholder="Apellido del paciente" x-model="currentPaciente.apellido">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_nac">
                                            Fecha de Nacimiento
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha_nac" name="fecha_nac" type="date" x-model="currentPaciente.fecha_nac" onchange="edadUpdate();">
                                    </div>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="edad" name="edad" type="number" placeholder="Edad del paciente" style="display: none" x-model="currentPaciente.edad">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="sexo">
                                            Sexo
                                        </label>
                                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sexo" name="sexo" x-model="currentPaciente.sexo">
                                            <option value="0">Masculino</option>
                                            <option value="1">Femenino</option>
                                            <option value="2">Otro</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">
                                            Teléfono
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" name="telefono" type="text" placeholder="Teléfono del paciente" x-model="currentPaciente.telefono">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                            Email
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Email del paciente" x-model="currentPaciente.email">
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                            <span x-show="!editMode">Registrar</span>
                                            <span x-show="editMode">Guardar</span>
                                        </button>
                                        <button @click="open = false; currentPaciente = {};" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Cancelar
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
@stop
