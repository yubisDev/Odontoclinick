@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles de la Cita</h2>

    <div class="card-body">
        <p><strong>ID:</strong> {{ $cita->id_cita }}</p>
        <p><strong>Paciente:</strong> {{ $cita->paciente->nombre ?? 'Sin asignar' }}</p>
        <p><strong>Horario:</strong> {{ $cita->horario->hora ?? 'N/A' }}</p>
        <p><strong>Fecha y Hora:</strong> {{ $cita->fecha_horario }}</p>
        <p><strong>Estado:</strong> {{ $cita->estado }}</p>
        <p><strong>Doctor:</strong> {{ $cita->doctor->nombre ?? 'Sin asignar' }}</p>
        <p><strong>Notas:</strong> {{ $cita->notas }}</p>
    </div>


    <a href="{{ route('citas.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
