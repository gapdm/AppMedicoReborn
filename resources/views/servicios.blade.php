@extends('layouts.main')
@section('title')
    Servicios
@stop

@section('content')
<div class="pt-2" x-data="{ open: false }">
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="grid grid-cols-10">
            <div class="col-span-2 mb-4 text-right">
                {{$servicios->links()}}
            </div>
            <div class="col-span-6"></div>
            <div class="col-span-2 text-right">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="open = true">Registrar Servicio</button>
            </div>
        </div>
        <table class="table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Servicio</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Acceso</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($servicios as $servicio)
                    <tr>
                        <td class="border px-4 py-2">{{$servicio->servicio}}</td>
                        <td class="border px-4 py-2">{{$servicio->precio}}</td>
                        <td class="border px-4 py-2">
                            {{ $servicio->acceso == 0 ? 'Secretaria' : ($servicio->acceso == 1 ? 'Medico' : 'Admin') }}
                        </td>
                        <td class="border px-4 py-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="border px-4 py-2 text-center">No hay servicios registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

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
                                    <form action="{{ route('servicios.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="servicio">
                                                Servicio
                                            </label>
                                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="servicio" name="servicio" type="text" placeholder="Nombre del servicio">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="precio">
                                                Precio
                                            </label>
                                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="precio" name="precio" type="number" step="0.01" min="0" placeholder="Precio del servicio">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="acceso">
                                                Acceso
                                            </label>
                                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="acceso" name="acceso">
                                                <option value="0">Secretaria</option>
                                                <option value="1">Medico</option>
                                                <option value="2">Admin</option>
                                            </select>
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
</div>
@endsection