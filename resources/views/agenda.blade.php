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

<div class="flex min-h-screen gap-4">
    <div class="w-4/12 mt-24 bg-white shadow rounded-lg flex flex-col">
        <div id="calendar" class="bg-white pr-4 pl-4 pt-4 shadow rounded-lg"></div>
        <div id="lista" class="bg-white pr-4 pl-4 pb-4 shadow rounded-lg flex-grow"></div>
    </div>

    <div class="w-8/12 pt-8" style="max-height:93vh;">
        <div class="flex justify-end mb-6">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Registrar Cita
            </button>
        </div>
        <div id="agenda" class="bg-white p-4 shadow rounded-lg h-full"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.14/index.global.min.js" integrity="sha512-JEbmnyttAbEkbkpvW1vRqBzY3Otrp0DFwux9+JQ6kXe2mQfUmBpImuREMZS0advTaaCMotaYB5gIng/uPw3r6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
