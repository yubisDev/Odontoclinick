@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Panel de Gestión de Horarios</h2>
        <a href="{{ route('horarios.create') }}" class="btn btn-primary">Agregar Nuevo Horario</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($medicos->isEmpty())
        <div class="alert alert-info">No hay médicos registrados en el sistema.</div>
    @else
        @foreach($medicos as $medico)
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h3>Médico: {{ $medico->nombre }} {{ $medico->apellidos }}</h3>
                    <p class="m-0">Especialidad: {{ $medico->especialidad->nombre_especialidad ?? 'No asignada' }}</p>
                </div>
                <div class="card-body">
                    @if($medico->horarios->isEmpty())
                        <div class="alert alert-info">No hay horarios asignados a este médico.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Día</th>
                                        <th>Hora de Inicio</th>
                                        <th>Hora de Fin</th>
                                        <th>Pacientes</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medico->horarios as $horario)
                                        <tr>
                                            <td>{{ $horario->dia_semana }}</td>
                                            <td>{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}</td>
                                            <td>{{ $horario->cant_pacientes }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('horarios.edit', $horario->id_horarios) }}" class="btn btn-warning btn-sm me-2">Editar</a>
                                                    <form action="{{ route('horarios.destroy', $horario->id_horarios) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este horario?')">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection