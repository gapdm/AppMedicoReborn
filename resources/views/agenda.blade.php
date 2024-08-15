@extends('layouts.main')
@section('title')
    Agenda de Citas
@stop

@section('content')

<style>
    .fc .fc-daygrid-day-frame {
        aspect-ratio: 1 / 1;
    }

    #calendar .fc-today-button{
        display: none;
    }

    #lista .fc-toolbar-chunk:first-child,
    #lista .fc-toolbar-chunk:nth-child(3) {
        display: none;
    }
</style>

<div x-data="{ open: false }" class="flex min-h-screen gap-4">
    <div class="w-4/12 mt-24 bg-white shadow rounded-lg flex flex-col">
        <div id="calendar" class="bg-white pr-4 pl-4 pt-4 shadow rounded-lg"></div>
        <div id="lista" class="bg-white pr-4 pl-4 pb-4 shadow rounded-lg flex-grow"></div>
    </div>

    <div class="w-8/12 pt-8" style="max-height:93vh;">
        <div class="flex justify-end mb-6">
            <button @click="open = true" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Registrar Cita
            </button>
        </div>
        <div id="agenda" class="bg-white p-4 shadow rounded-lg h-full"></div>
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
                                <form action="{{route('agenda.store')}}" method="POST">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.14/index.global.min.js" integrity="sha512-JEbmnyttAbEkbkpvW1vRqBzY3Otrp0DFwux9+JQ6kXe2mQfUmBpImuREMZS0advTaaCMotaYB5gIng/uPw3r6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const fechaInput = document.getElementById('fecha');
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const nowString = `${year}-${month}-${day}T${hours}:${minutes}`;
        
        fechaInput.min = nowString;

        fechaInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const dayOfWeek = selectedDate.getUTCDay();

            if (dayOfWeek === 0) {
                alert('Los domingos no están permitidos. Por favor, elige otra fecha.');
                this.value = '';
            } else {
                const selectedYear = selectedDate.getFullYear();
                const selectedMonth = String(selectedDate.getMonth() + 1).padStart(2, '0');
                const selectedDay = String(selectedDate.getDate()).padStart(2, '0');
                const selectedHours = String(selectedDate.getHours()).padStart(2, '0');
                this.value = `${selectedYear}-${selectedMonth}-${selectedDay}T${selectedHours}:00`;
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var agendaEl = document.getElementById('agenda');
        var listaEl = document.getElementById('lista');

        var citas = @json($citas);
        var pacientes = @json($pacientes);

        var events = citas.map(function(cita) {
            var pacienteCita = pacientes.find(function(paciente) {
                return paciente.id == cita.paciente_id;
            });
            if (!cita.motivo_consulta) {
                cita.motivo_consulta = "Cita";
            }
            return {
                title: pacienteCita.nombre + ' ' + pacienteCita.apellido + ' - ' + cita.motivo_consulta,
                start: cita.fecha,
                id: cita.id
            };
        });

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: false,
            dateClick: function(info) {
                agendaCalendar.gotoDate(info.date);
                listaCalendar.gotoDate(info.date);
            }
        });

        var agendaCalendar = new FullCalendar.Calendar(agendaEl, {
            initialView: 'timeGridWeek',
            selectable: true,
            height: '100%',
            events: events,
            dateClick: function(info) {
                calendar.gotoDate(info.date);
                listaCalendar.gotoDate(info.date);
            },
            eventClick: function(info) {
                var cita = citas.find(function(cita) {
                    return cita.id == info.event.id;
                });
                var pacienteCita = pacientes.find(function(paciente) {
                    return paciente.id == cita.paciente_id;
                });
                var details = `Paciente: ${pacienteCita.nombre} ${pacienteCita.apellido}\nMédico: ${cita.medico_id}\nFecha: ${cita.fecha}\nMotivo: ${cita.motivo_consulta}`;
                alert(details);
            }
        });

        var listaCalendar = new FullCalendar.Calendar(listaEl, {
            initialView: 'listWeek',
            selectable: true,
            height: '100%',
            events: events,
            dateClick: function(info) {
                calendar.gotoDate(info.date);
                agendaCalendar.gotoDate(info.date);
            },
            eventClick: function(info) {
                var cita = citas.find(function(cita) {
                    return cita.id == info.event.id;
                });
                var pacienteCita = pacientes.find(function(paciente) {
                    return paciente.id == cita.paciente_id;
                });
                var details = `Paciente: ${pacienteCita.nombre} ${pacienteCita.apellido}\nMédico: ${cita.medico_id}\nFecha: ${cita.fecha}\nMotivo: ${cita.motivo_consulta}`;
                alert(details);
            }
        });

        calendar.render();
        agendaCalendar.render();
        listaCalendar.render();
    });
</script>

@stop
