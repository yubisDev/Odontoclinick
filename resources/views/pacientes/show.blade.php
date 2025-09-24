@extends('layouts.app')

@section('title', 'Mis Datos')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white p-4 d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Mis Datos</h2>
                    <a href="{{ route('pacientes.edit', ['paciente' => $paciente->id_paciente]) }}" class="btn btn-light btn-sm">
                        <i class="bi bi-pencil-square me-2"></i> Editar Datos
                    </a>
                </div>
                <div class="card-body p-4">

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 bg-light">
                                <div class="card-header text-primary fw-bold">Información de Contacto</div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><i class="bi bi-envelope-fill me-2 text-primary"></i> {{ $paciente->correo }}</li>
                                        <li class="mb-2"><i class="bi bi-telephone-fill me-2 text-primary"></i> {{ $paciente->telefono ?? 'No especificado' }}</li>
                                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> {{ $paciente->direccion ?? 'No especificado' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 bg-light">
                                <div class="card-header text-primary fw-bold">Detalles Médicos</div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><i class="bi bi-calendar-check me-2 text-primary"></i> <span class="fw-bold">Fecha de Nacimiento:</span> {{ $paciente->fecha_nacimiento ?? 'No especificado' }}</li>
                                        <li class="mb-2"><i class="bi bi-hospital-fill me-2 text-primary"></i> <span class="fw-bold">EPS:</span> {{ $paciente->eps ?? 'No especificado' }}</li>
                                        <li class="mb-2"><i class="bi bi-droplet-half me-2 text-primary"></i> <span class="fw-bold">RH:</span> {{ $paciente->rh ?? 'No especificado' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection