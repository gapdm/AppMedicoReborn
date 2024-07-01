@extends('layouts.main')
@section('title')
    Agenda de Citas
@stop

@section('content')
<div class="grid grid-cols-5 min-h-screen gap-4">
    <div class="col-span-2 mt-8 bg-white shadow rounded-lg">
        <div id="calendar" class="bg-white p-4 shadow rounded-lg" style="height: 400px;"></div>

        <div class="mt-4 bg-slate-50">
            <h2 class="text-xl font-semibold text-gray-700">Lista de Datos</h2>
            <ul class="list-disc list-inside">
                <li>Dato de ejemplo 1</li>
                <li>Dato de ejemplo 2</li>
                <li>Dato de ejemplo 3</li>
            </ul>
        </div>
    </div>

    <div class="col-span-3 pt-8">
        <div id="agenda" class="bg-white p-4 shadow rounded-lg"></div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.css">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var agendaEl = document.getElementById('agenda');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                {
                    title: 'Evento 1',
                    start: '2024-06-23T10:00:00'
                },
                {
                    title: 'Evento 2',
                    start: '2024-06-23T12:00:00'
                },
                {
                    title: 'Evento 3',
                    start: '2024-06-23T14:00:00'
                }
            ],
            selectable: true
        });

        // Configurar el calendario de la agenda del día
        var agendaCalendar = new FullCalendar.Calendar(agendaEl, {
            initialView: 'timeGridWeek',
            events: [
                {
                    title: 'Evento 1',
                    start: '2024-06-23T10:00:00'
                },
                {
                    title: 'Evento 2',
                    start: '2024-06-23T12:00:00'
                },
                {
                    title: 'Evento 3',
                    start: '2024-06-23T14:00:00'
                }
            ],
            selectable: true,
            height: '100%' // Ajustar la altura al 100% del contenedor
        });

        calendar.render();
        agendaCalendar.render(); // Renderizar el calendario de la agenda del día
    });
</script>
@stop
