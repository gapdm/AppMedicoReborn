@extends('layouts.main')
@section('title')
    Ventas
@stop

@section('content')
<div class="p-2" x-data="{ open: false, venta: null, editMode: false, total: 0, selectedServicios: [], calcularTotal() {
                let sum = 0;
                this.selectedServicios.forEach(id => {
                    const checkbox = document.querySelector(`#servicio-${id}`);
                    if (checkbox) {
                        sum += parseFloat(checkbox.dataset.precio);
                    }
                });
                this.total = sum.toFixed(2);
            } }">
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="mt-4 mb-4 items-end">
            <button @click="open = true; editMode = false; venta = null; selectedServicios = []; total = 0;" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Registrar venta
            </button>
        </div>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Paciente</th>
                    <th class="px-4 py-2">Médico</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta)
                <tr>
                    <td class="border px-4 py-2">
                        {{ $venta->id }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $venta->paciente->nombre }} {{ $venta->paciente->apellido }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ $venta->medico->nombre }} {{ $venta->medico->apellido }}
                    </td>
                    <td class="border px-4 py-2">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td class="border px-4 py-2">${{ number_format($venta->total, 2) }}</td>
                    <td class="border px-4 py-2 flex space-x-2">
                        <button @click="open = true; editMode = true; venta = {{ $venta->toJson() }}; selectedServicios = {{ json_encode($venta->servicios->pluck('id')) }}; calcularTotal();" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Modificar
                        </button>
                        @if (Auth::user()->rol!=0)
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                                    Eliminar
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="border px-4 py-2 text-center">No hay ventas registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal para registrar/modificar venta -->
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
                                <span x-show="!editMode">Registrar Nueva Venta</span>
                                <span x-show="editMode">Modificar Venta</span>
                            </h3>
                            <div class="mt-2">
                                <form :action="editMode ? '{{ route('ventas.update', '') }}/' + venta.id : '{{ route('ventas.store') }}'" method="POST" id="ventaForm">
                                    @csrf
                                    <template x-if="editMode">
                                        <input type="hidden" name="_method" value="PUT">
                                    </template>
                                    <div class="mb-4">
                                        <label for="paciente_id" class="block text-gray-700">Paciente</label>
                                        <select name="paciente_id" id="paciente_id" class="w-full border border-gray-300 p-2 rounded-lg" x-model="venta.paciente_id">
                                            @foreach($pacientes as $paciente)
                                                <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="medico_id" class="block text-gray-700">Médico</label>
                                        <select name="medico_id" id="medico_id" class="w-full border border-gray-300 p-2 rounded-lg" x-model="venta.medico_id">
                                            @foreach($medicos as $medico)
                                                <option value="{{ $medico->id }}">{{ $medico->nombre }} {{ $medico->apellido }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="servicios" class="block text-gray-700">Servicios</label>
                                        <div>
                                            @foreach($servicios as $servicio)
                                                <div class="flex items-center mb-2">
                                                    <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}" class="mr-2" id="servicio-{{ $servicio->id }}" x-model="selectedServicios" @change="calcularTotal">
                                                    <label for="servicio-{{ $servicio->id }}" class="text-gray-700">{{ $servicio->servicio }} - ${{ $servicio->precio }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="total" class="block text-gray-700">Total</label>
                                        <input type="number" name="total" id="total" class="w-full border border-gray-300 p-2 rounded-lg" step="0.01" x-bind:value="total" readonly>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" @click="open = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            <span x-show="!editMode">Guardar</span>
                                            <span x-show="editMode">Actualizar</span>
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
