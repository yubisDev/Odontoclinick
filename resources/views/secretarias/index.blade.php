@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Secretarias</h2>
        <a href="{{ route('secretarias.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus-fill"></i> Agregar Secretaria
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
            <!-- Botones tipo toggle para Activas/Inactivas -->
            <div class="mb-4 d-flex gap-2">
                <button class="btn btn-outline-success active" id="btn-activas">
                    Activas ({{ $secretarias_activas->count() }})
                </button>
                <button class="btn btn-outline-danger" id="btn-inactivas">
                    Inactivas ({{ $secretarias_inactivas->count() }})
                </button>
            </div>

            <div id="secretariaTabsContent">
                <!-- Secretarias activas -->
                <div class="secretarias-tab" id="activas-tab-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($secretarias_activas as $secretaria)
                                    <tr>
                                        <td>{{ $secretaria->id_secretaria }}</td>
                                        <td>{{ $secretaria->nombre }} {{ $secretaria->apellidos }}</td>
                                        <td>{{ $secretaria->telefono }}</td>
                                        <td>{{ $secretaria->correo }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('secretarias.edit', $secretaria->id_secretaria) }}" class="btn btn-primary btn-sm me-1">
                                                <i class="bi bi-pencil-fill"></i> Editar
                                            </a>
                                            <form action="{{ route('secretarias.destroy', $secretaria->id_secretaria) }}" method="POST" class="d-inline">
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
                                        <td colspan="5" class="text-center">No hay secretarias activas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Secretarias inactivas -->
                <div class="secretarias-tab d-none" id="inactivas-tab-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($secretarias_inactivas as $secretaria)
                                    <tr>
                                        <td>{{ $secretaria->id_secretaria }}</td>
                                        <td>{{ $secretaria->nombre }} {{ $secretaria->apellidos }}</td>
                                        <td>{{ $secretaria->telefono }}</td>
                                        <td>{{ $secretaria->correo }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('secretarias.reactivar', $secretaria->id_secretaria) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm">
                                                    <i class="bi bi-arrow-counterclockwise"></i> Reactivar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay secretarias inactivas.</td>
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
    const btnActivas = document.getElementById('btn-activas');
    const btnInactivas = document.getElementById('btn-inactivas');
    const activasContent = document.getElementById('activas-tab-content');
    const inactivasContent = document.getElementById('inactivas-tab-content');

    btnActivas.addEventListener('click', () => {
        activasContent.classList.remove('d-none');
        inactivasContent.classList.add('d-none');
        btnActivas.classList.add('active');
        btnInactivas.classList.remove('active');
    });

    btnInactivas.addEventListener('click', () => {
        inactivasContent.classList.remove('d-none');
        activasContent.classList.add('d-none');
        btnInactivas.classList.add('active');
        btnActivas.classList.remove('active');
    });
</script>
@endsection
