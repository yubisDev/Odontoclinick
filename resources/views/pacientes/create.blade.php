@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Agregar Paciente</h2>

    <form action="{{ route('pacientes.store') }}" method="POST">
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
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="correo">Correo</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="eps">EPS</label>
                <input type="text" name="eps" class="form-control" value="{{ old('eps') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="rh">RH</label>
                <input type="text" name="rh" class="form-control" value="{{ old('rh') }}">
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
        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
