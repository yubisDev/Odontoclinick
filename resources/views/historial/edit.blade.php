@extends('layouts.app')

@section('title', 'Editar Historial')

@section('content')
<div class="container mt-4">
    <h2>Editar Historial</h2>
    <hr>

    <form action="{{ route('historial.update', $historial->id_historial) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $historial->fecha) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Procedimiento Realizado</label>
            <textarea name="procedimiento_realizado" class="form-control" required>{{ old('procedimiento_realizado', $historial->procedimiento_realizado) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Diagnóstico</label>
            <textarea name="diagnostico" class="form-control" required>{{ old('diagnostico', $historial->diagnostico) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('historial.index_all', $historial->id_paciente) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
