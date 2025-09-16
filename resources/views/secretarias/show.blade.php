@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Médico</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $medico->id_doctor }}</p>
            <p><strong>Nombre:</strong> {{ $medico->nombre }} {{ $medico->apellidos }}</p>
            <p><strong>Teléfono:</strong> {{ $medico->telefono }}</p>
            <p><strong>Correo:</strong> {{ $medico->correo }}</p>
            <p><strong>Especialidad:</strong> {{ $medico->especialidad->nombre_especialidad ?? 'Sin especialidad' }}</p>
            <p><strong>Estado:</strong> {{ $medico->estado }}</p>
        </div>
    </div>

    <a href="{{ route('medicos.index') }}" class="btn btn-primary mt-3">Volver al listado</a>
</div>
@endsection
