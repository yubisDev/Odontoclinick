@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Editar Paciente</h2>

    <form action="{{ route('pacientes.update', $paciente->id_paciente) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Datos personales -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                Datos Personales
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $paciente->nombre) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos', $paciente->apellidos) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control" value="{{ old('correo', $paciente->correo) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="eps" class="form-label">EPS</label>
                        <input type="text" name="eps" class="form-control" value="{{ old('eps', $paciente->eps) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rh" class="form-label">RH</label>
                        <input type="text" name="rh" class="form-control" value="{{ old('rh', $paciente->rh) }}">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="activo" {{ old('estado', $paciente->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('estado', $paciente->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Datos de usuario -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-secondary text-white">
                Datos de Usuario
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                        <input type="text" name="nombre_usuario" class="form-control" value="{{ old('nombre_usuario', $paciente->usuario->nombre_usuario ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contraseña" class="form-label">Nueva contraseña (opcional)</label>
                        <input type="password" name="contraseña" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="d-flex">
    <button type="submit" class="btn btn-success me-2">
        <i class="bi bi-save-fill me-1"></i> Actualizar
    </button>
    
    @if(Auth::user()->id_rol == 4)
        <a href="{{ route('pacientes.show', Auth::user()->paciente->id_usuario) }}" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Cancelar
        </a>
    @else
        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Cancelar
        </a>
    @endif
</div>
    </form>
</div>
@endsection
