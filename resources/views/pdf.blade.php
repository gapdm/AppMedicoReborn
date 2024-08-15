<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita Médica PDF</title>
</head>
<body>
    <h1>Detalles de la Cita Médica</h1>
    <p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
    <p><strong>Paciente:</strong> {{ $paciente->nombre }} {{ $paciente->apellido }}</p>
    <p><strong>Médico:</strong> {{ $medico->nombre }} {{ $medico->apellido }}</p>
    <p><strong>Motivo de la Consulta:</strong> {{ $cita->motivo_consulta }}</p>

    <h3>Datos de la Cita</h3>
    <p><strong>Estatura:</strong> {{ $cita->talla }}</p>
    <p><strong>Peso:</strong> {{ $cita->peso }}</p>
    <p><strong>Frecuencia Cardiaca:</strong> {{ $cita->frecuencia_cardiaca }}</p>
    <p><strong>Temperatura:</strong> {{ $cita->temperatura }}</p>
    <p><strong>Notas de Padecimiento:</strong> {{ $cita->notas_padecimiento }}</p>
    <p><strong>Estado:</strong> {{ $cita->estado == 0 ? 'Asignada' : ($cita->estado == 1 ? 'Empezada' : 'Terminada') }}</p>
</body>
</html>