@extends('layouts.app')

@section('title', 'Registrar Historial')

@section('content')
<div class="container mt-4">
    <h2>Registrar Historial Clínico</h2>
    <hr>

    <form action="{{ route('historial.store') }}" method="POST">
        @csrf

        <!-- Id paciente -->
        <input type="hidden" name="id_paciente" value="{{ $paciente->id_paciente }}">
        <!-- Id cita, solo si existe -->
        <input type="hidden" name="id_cita" value="{{ $cita?->id_cita }}">

        <!-- Paciente -->
        <div class="mb-3">
            <label class="form-label">Paciente</label>
            <input type="text" class="form-control" value="{{ $paciente->nombre }} {{ $paciente->apellidos }}" disabled>
        </div>

        <!-- Fecha -->
        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', now()->toDateString()) }}" required>
        </div>

        <!-- Procedimiento -->
        <div class="mb-3">
            <label class="form-label">Procedimiento Realizado</label>
            <textarea name="procedimiento_realizado" class="form-control" required>{{ old('procedimiento_realizado') }}</textarea>
        </div>

        <!-- Diagnóstico -->
        <div class="mb-3">
            <label class="form-label">Diagnóstico</label>
            <textarea name="diagnostico" class="form-control" required>{{ old('diagnostico') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('historial.index_all', $paciente->id_paciente) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
