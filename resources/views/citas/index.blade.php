@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Citas</h2>
        <a href="{{ route('citas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg me-1"></i> Agregar Cita
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('citas.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="paciente" class="form-label">Paciente</label>
                        <input type="text" name="paciente" id="paciente" class="form-control" placeholder="Escribe para buscar o selecciona" value="{{ request('paciente') }}" list="pacientesList">
                        <datalist id="pacientesList">
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->nombre }} {{ $paciente->apellidos }}">
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-md-4">
                        <label for="medico" class="form-label">Doctor</label>
                        <input type="text" name="medico" id="medico" class="form-control" placeholder="Escribe para buscar o selecciona" value="{{ request('medico') }}" list="medicosList">
                        <datalist id="medicosList">
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->nombre }} {{ $medico->apellidos }}">
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-md-4">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-select">
                            <option value="">Todos</option>
                            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i> Aplicar Filtros
                        </button>
                        <a href="{{ route('citas.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Fecha y Hora</th>
                    <th>Estado</th>
                    <th>Notas</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                    <tr>
                        <td>{{ $cita->id_cita }}</td>
                        <td>{{ $cita->paciente->nombre ?? '' }} {{ $cita->paciente->apellidos ?? '' }}</td>
                        <td>{{ $cita->medico->nombre ?? '' }} {{ $cita->medico->apellidos ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('d/m/Y H:i') }}</td>
                        <td>
                            @php
                                $estado = $cita->estado ?? 'desconocido';
                                $badgeClass = match($estado) {
                                    'pendiente' => 'bg-warning text-dark',
                                    'confirmada' => 'bg-success',
                                    'cancelada' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($estado) }}</span>
                        </td>
                        <td>{{ $cita->notas }}</td>
                        <td class="text-center">
                            <a href="{{ route('citas.edit', $cita->id_cita) }}" class="btn btn-primary btn-sm me-1">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('citas.destroy', $cita->id_cita) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay citas registradas que coincidan con los filtros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection