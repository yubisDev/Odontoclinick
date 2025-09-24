@extends('layouts.app')

@section('title', 'Perfil Médico')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Perfil Médico</h2>
        <p class="text-muted">Visualiza y actualiza tu información personal</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>{{ $medico->nombre }} {{ $medico->apellidos }}</h5>
            <a href="{{ route('medicos.edit', $medico->id_doctor) }}" class="btn btn-light btn-sm">
                <i class="bi bi-pencil-square me-1"></i>Editar Perfil
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <p class="mb-1"><strong><i class="bi bi-envelope-fill me-1"></i>Correo:</strong> {{ $medico->correo }}</p>
                    <p class="mb-1"><strong><i class="bi bi-telephone-fill me-1"></i>Teléfono:</strong> {{ $medico->telefono }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong><i class="bi bi-journal-medical me-1"></i>Especialidad:</strong> {{ $medico->especialidad->nombre_especialidad ?? 'No asignada' }}</p>
                    <p class="mb-1"><strong><i class="bi bi-person-badge-fill me-1"></i>Usuario:</strong> {{ $medico->usuario->nombre_usuario ?? '-' }}</p>
                </div>
            </div>
            <p class="mb-0"><strong><i class="bi bi-toggle-on me-1"></i>Estado:</strong> 
                <span class="{{ $medico->estado == 'activo' ? 'text-success' : 'text-danger' }}">
                    {{ ucfirst($medico->estado) }}
                </span>
            </p>
        </div>
    </div>
</div>
@endsection
