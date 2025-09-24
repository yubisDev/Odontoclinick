@extends('layouts.app')

@section('title', 'Editar Perfil Médico')

@section('content')
<div class="container mt-5">
    <div class="row">
        {{-- Perfil a la izquierda --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $medico->nombre }} {{ $medico->apellidos }}</h5>
                    <p class="text-muted mb-1"><i class="bi bi-envelope-fill me-2"></i>{{ $medico->correo }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-telephone-fill me-2"></i>{{ $medico->telefono }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-journal-medical me-2"></i>{{ $medico->especialidad->nombre_especialidad ?? 'No asignada' }}</p>
                    <p class="text-muted mb-0"><i class="bi bi-toggle-on me-2"></i>
                        <span class="{{ $medico->estado == 'activo' ? 'text-success' : 'text-danger' }}">
                            {{ ucfirst($medico->estado) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Formulario a la derecha --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4">
                <h4 class="mb-4 text-primary"><i class="bi bi-pencil-square me-2"></i>Editar Información</h4>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                <form action="{{ route('medicos.perfil.update', $medico->id_doctor) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre', $medico->nombre) }}" required>
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror"
                                value="{{ old('apellidos', $medico->apellidos) }}" required>
                            @error('apellidos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                                value="{{ old('telefono', $medico->telefono) }}">
                            @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Correo</label>
                            <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror"
                                value="{{ old('correo', $medico->correo) }}" required>
                            @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Especialidad</label>
                            <select name="id_especialidad" class="form-select @error('id_especialidad') is-invalid @enderror" required>
                                <option value="">-- Seleccione --</option>
                                @foreach ($especialidad as $esp)
                                    <option value="{{ $esp->id_especialidad }}"
                                        {{ old('id_especialidad', $medico->id_especialidad) == $esp->id_especialidad ? 'selected' : '' }}>
                                        {{ $esp->nombre_especialidad }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_especialidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="activo" {{ old('estado', $medico->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado', $medico->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3 text-primary"><i class="bi bi-person-circle me-2"></i>Datos de Usuario</h5>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" name="nombre_usuario" class="form-control @error('nombre_usuario') is-invalid @enderror"
                                value="{{ old('nombre_usuario', $medico->usuario->nombre_usuario ?? '') }}" required>
                            @error('nombre_usuario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nueva contraseña (opcional)</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <button type="submit" class="btn btn-primary me-2"><i class="bi bi-arrow-clockwise me-1"></i>Actualizar</button>
                        <a href="{{ route('medicos.show', $medico->id_doctor) }}" class="btn btn-secondary"><i class="bi bi-x-circle me-1"></i>Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
