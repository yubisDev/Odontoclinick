@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Médico</h2>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicos.update', $medico->id_doctor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $medico->nombre) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos', $medico->apellidos) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $medico->telefono) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="correo">Correo</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo', $medico->correo) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="id_especialidad">Especialidad</label>
                <select name="id_especialidad" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    @foreach ($especialidades as $esp)
                        <option value="{{ $esp->id_especialidad }}" 
                            {{ old('id_especialidad', $medico->id_especialidad) == $esp->id_especialidad ? 'selected' : '' }}>
                            {{ $esp->nombre_especialidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="activo" {{ old('estado', $medico->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado', $medico->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>

        <hr>
        <h4>Datos de usuario</h4>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre_usuario">Nombre de usuario</label>
                <input type="text" name="nombre_usuario" class="form-control" 
                    value="{{ old('nombre_usuario', $medico->usuario->nombre_usuario ?? '') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="contraseña">Nueva contraseña (opcional)</label>
                <input type="password" name="contraseña" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
