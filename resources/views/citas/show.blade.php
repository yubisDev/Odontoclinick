@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de la Cita</h1>

    <div class="card">
        <div class="card-body">
            <h5><strong>Paciente:</strong> {{ $cita->paciente->nombre }} {{ $cita->paciente->apellidos }}</h5>
            <p><strong>Médico:</strong> {{ $cita->medico->nombre }} {{ $cita->medico->apellidos }}</p>
            <p><strong>Fecha y Hora:</strong> {{ $cita->fecha_horario }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($cita->estado) }}</p>
            <p><strong>Notas:</strong> {{ $cita->notas ?? 'Sin notas' }}</p>
        </div>
    </div>

    <a href="{{ route('citas.index') }}" class="btn btn-secondary mt-3">Volver</a>
    <a href="{{ route('citas.edit', $cita->id_cita) }}" class="btn btn-warning mt-3">Editar</a>
    <form action="{{ route('citas.destroy', $cita->id_cita) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button class="btn btn-danger mt-3" onclick="return confirm('¿Eliminar esta cita?')">Eliminar</button>
    </form>
</div>
@endsection
