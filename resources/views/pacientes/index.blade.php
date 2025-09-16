@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Listado de Pacientes</h2>

    <a href="{{ route('pacientes.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-lg me-1"></i> Agregar Paciente
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Pestañas personalizadas -->
    <ul class="nav nav-pills mb-3" id="pacienteTabs" role="tablist">
        <li class="nav-item me-2" role="presentation">
            <button class="nav-link active fw-bold text-white" 
                    id="activos-tab" data-bs-toggle="pill" data-bs-target="#activos" type="button"
                    style="background-color: #0d6efd; border-radius: 50px; transition: all 0.3s;">
                Activos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-white" 
                    id="inactivos-tab" data-bs-toggle="pill" data-bs-target="#inactivos" type="button"
                    style="background-color: #dc3545; border-radius: 50px; transition: all 0.3s;">
                Inactivos
            </button>
        </li>
    </ul>

    <div class="tab-content" id="pacienteTabsContent">
        <!-- Pacientes activos -->
        <div class="tab-pane fade show active" id="activos">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>EPS</th>
                            <th>RH</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacientes_activas as $paciente)
                            <tr>
                                <td>{{ $paciente->id_paciente }}</td>
                                <td>{{ $paciente->nombre }} {{ $paciente->apellidos }}</td>
                                <td>{{ $paciente->correo }}</td>
                                <td>{{ $paciente->telefono }}</td>
                                <td>{{ $paciente->eps }}</td>
                                <td>{{ $paciente->rh }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pacientes.edit', $paciente->id_paciente) }}" 
                                       class="btn btn-primary btn-sm me-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('pacientes.destroy', $paciente->id_paciente) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pacientes inactivos -->
        <div class="tab-pane fade" id="inactivos">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-danger">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>EPS</th>
                            <th>RH</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacientes_inactivas as $paciente)
                            <tr>
                                <td>{{ $paciente->id_paciente }}</td>
                                <td>{{ $paciente->nombre }} {{ $paciente->apellidos }}</td>
                                <td>{{ $paciente->correo }}</td>
                                <td>{{ $paciente->telefono }}</td>
                                <td>{{ $paciente->eps }}</td>
                                <td>{{ $paciente->rh }}</td>
                                <td class="text-center">
                                    <form action="{{ route('pacientes.reactivar', $paciente->id_paciente) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
