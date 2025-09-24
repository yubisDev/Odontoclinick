@extends('layouts.app')

@section('title', 'Historiales Clínicos')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">📋 Historiales Clínicos</h2>

    {{-- ✅ Filtros multicriterio --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">🔎 Filtros de búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('historial.index_all') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Paciente</label>
                        <input type="text" name="paciente" class="form-control" value="{{ request('paciente') }}" placeholder="Nombre o apellido">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Desde</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Hasta</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Procedimiento</label>
                        <input type="text" name="procedimiento" class="form-control" value="{{ request('procedimiento') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Diagnóstico</label>
                        <input type="text" name="diagnostico" class="form-control" value="{{ request('diagnostico') }}">
                    </div>
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ✅ Resultados --}}
    @if($historiales->isEmpty())
        <div class="alert alert-info text-center shadow-sm">
            No se encontraron historiales con los filtros aplicados.
        </div>
    @else
        <div class="accordion" id="accordionHistoriales">
            @foreach($historiales as $pacienteHistoriales)
                @php
                    $paciente = $pacienteHistoriales->first()->paciente;
                @endphp
                <div class="accordion-item shadow-sm mb-3 rounded">
                    <h2 class="accordion-header" id="heading{{ $paciente->id_paciente }}">
                        <button 
                            class="accordion-button collapsed fw-bold" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapse{{ $paciente->id_paciente }}" 
                            aria-expanded="false" 
                            aria-controls="collapse{{ $paciente->id_paciente }}">
                            👤 {{ $paciente->nombre }} {{ $paciente->apellidos }}
                        </button>
                    </h2>
                    <div 
                        id="collapse{{ $paciente->id_paciente }}" 
                        class="accordion-collapse collapse" 
                        aria-labelledby="heading{{ $paciente->id_paciente }}" 
                        data-bs-parent="#accordionHistoriales">
                        <div class="accordion-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>📅 Fecha</th>
                                            <th>🩺 Procedimiento</th>
                                            <th>📝 Diagnóstico</th>
                                            <th class="text-center">⚙️ Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pacienteHistoriales as $historial)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($historial->fecha)->format('d/m/Y') }}</td>
                                                <td>{{ $historial->procedimiento_realizado }}</td>
                                                <td>{{ $historial->diagnostico }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('historial.show', $historial->id_historial) }}" class="btn btn-outline-info btn-sm me-1">
                                                        <i class="bi bi-eye"></i> Ver
                                                    </a>
                                                    <a href="{{ route('historial.edit', $historial->id_historial) }}" class="btn btn-outline-warning btn-sm">
                                                        <i class="bi bi-pencil-square"></i> Editar
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
