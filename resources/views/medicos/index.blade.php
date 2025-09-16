@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Médicos</h2>
        <a href="{{ route('medicos.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus-fill"></i> Agregar Médico
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <!-- Botones tipo toggle para Activos/Inactivos -->
            <div class="mb-4 d-flex gap-2">
                <button class="btn btn-outline-primary active" id="btn-activos">
                    Activos ({{ $medicos->where('estado', 'activo')->count() }})
                </button>
                <button class="btn btn-outline-danger" id="btn-inactivos">
                    Inactivos ({{ $medicos->where('estado', 'inactivo')->count() }})
                </button>
            </div>

            <div id="medicoTabsContent">
                <!-- Médicos activos -->
                <div class="medicos-tab" id="activos-tab-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Especialidad</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($medicos->where('estado', 'activo') as $medico)
                                    <tr>
                                        <td>{{ $medico->id_doctor }}</td>
                                        <td>{{ $medico->nombre }} {{ $medico->apellidos }}</td>
                                        <td>{{ $medico->telefono }}</td>
                                        <td>{{ $medico->correo }}</td>
                                        <td>{{ $medico->especialidad->nombre_especialidad ?? 'Sin especialidad' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('medicos.edit', $medico->id_doctor) }}" class="btn btn-primary btn-sm me-1">
                                                <i class="bi bi-pencil-fill"></i> Editar
                                            </a>
                                            <form action="{{ route('medicos.destroy', $medico->id_doctor) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="bi bi-x-circle-fill"></i> Inactivar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No hay médicos activos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Médicos inactivos -->
                <div class="medicos-tab d-none" id="inactivos-tab-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-danger">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Especialidad</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($medicos->where('estado', 'inactivo') as $medico)
                                    <tr>
                                        <td>{{ $medico->id_doctor }}</td>
                                        <td>{{ $medico->nombre }} {{ $medico->apellidos }}</td>
                                        <td>{{ $medico->telefono }}</td>
                                        <td>{{ $medico->correo }}</td>
                                        <td>{{ $medico->especialidad->nombre_especialidad ?? 'Sin especialidad' }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('medicos.reactivar', $medico->id_doctor) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm">
                                                    <i class="bi bi-arrow-counterclockwise"></i> Reactivar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No hay médicos inactivos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para toggle de botones -->
<script>
    const btnActivos = document.getElementById('btn-activos');
    const btnInactivos = document.getElementById('btn-inactivos');
    const activosContent = document.getElementById('activos-tab-content');
    const inactivosContent = document.getElementById('inactivos-tab-content');

    btnActivos.addEventListener('click', () => {
        activosContent.classList.remove('d-none');
        inactivosContent.classList.add('d-none');
        btnActivos.classList.add('active');
        btnInactivos.classList.remove('active');
    });

    btnInactivos.addEventListener('click', () => {
        inactivosContent.classList.remove('d-none');
        activosContent.classList.add('d-none');
        btnInactivos.classList.add('active');
        btnActivos.classList.remove('active');
    });
</script>
@endsection
