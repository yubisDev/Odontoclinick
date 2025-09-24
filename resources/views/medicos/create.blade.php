@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Agregar Médico</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('medicos.store') }}" method="POST">
        @csrf

        <h4>Datos del Médico</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" required>
                @error('apellidos')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="correo">Correo</label>
                <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
                @error('correo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="id_especialidad">Especialidad</label>
                <select name="id_especialidad" class="form-control @error('id_especialidad') is-invalid @enderror" required>
                    <option value="">Seleccione una especialidad</option>
                    @foreach ($especialidad as $especialidad)
                        <option value="{{ $especialidad->id_especialidad }}" {{ old('id_especialidad') == $especialidad->id_especialidad ? 'selected' : '' }}>
                            {{ $especialidad->nombre_especialidad }}
                        </option>
                    @endforeach
                </select>
                @error('id_especialidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control @error('estado') is-invalid @enderror" required>
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr>

        <h4>Datos de Usuario</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre_usuario">Nombre de usuario</label>
                <input type="text" name="nombre_usuario" class="form-control @error('nombre_usuario') is-invalid @enderror" value="{{ old('nombre_usuario') }}" required>
                @error('nombre_usuario')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="d-flex justify-content-start align-items-center mt-4">
            <button type="submit" class="btn btn-primary me-2">
                <i class="bi bi-person-plus-fill me-1"></i> Agregar Médico
            </button>
            <a href="{{ route('medicos.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle me-1"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection