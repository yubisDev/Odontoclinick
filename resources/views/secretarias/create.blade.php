@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Agregar Secretaria</h2>

    {{-- Mostrar errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('secretarias.store') }}" method="POST">
        @csrf

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
                <label for="fecha_ingreso">Fecha de ingreso</label>
                <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', date('Y-m-d')) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="activo" {{ old('estado', 'activo') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>

        <hr>
        <h4>Datos de usuario</h4>

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

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('secretarias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
