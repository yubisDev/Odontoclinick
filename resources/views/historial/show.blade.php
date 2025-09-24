@extends('layouts.app')

@section('title', 'Detalle Historial')

@section('content')
<div class="container mt-4">
    <h2>Detalle del Historial</h2>
    <hr>

    <p><strong>Paciente:</strong> {{ $historial->paciente->nombre }} {{ $historial->paciente->apellidos }}</p>
    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($historial->fecha)->format('d/m/Y') }}</p>
    <p><strong>Procedimiento:</strong> {{ $historial->procedimiento_realizado }}</p>
    <p><strong>Diagnóstico:</strong> {{ $historial->diagnostico }}</p>

    <a href="{{ route('historial.index_all', $historial->id_paciente) }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
