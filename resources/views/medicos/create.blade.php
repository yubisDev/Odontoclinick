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
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="correo">Correo</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="id_especialidad">Especialidad</label>
                <select name="id_especialidad" class="form-control" required>
                    <option value="">Seleccione una especialidad</option>
                    @foreach ($especialidades as $especialidad)
                        <option value="{{ $especialidad->id_especialidad }}" {{ old('id_especialidad') == $especialidad->id_especialidad ? 'selected' : '' }}>
                            {{ $especialidad->nombre_especialidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>

        <hr>
        <h4>Datos de Usuario</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre_usuario">Nombre de usuario</label>
                <input type="text" name="nombre_usuario" class="form-control" value="{{ old('nombre_usuario') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Médico</button>
        <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
