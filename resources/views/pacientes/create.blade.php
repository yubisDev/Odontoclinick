@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Agregar Paciente</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Hay problemas con los datos ingresados.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pacientes.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" required>
                @error('apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}" required>
                @error('fecha_nacimiento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="correo">Correo</label>
                <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
                @error('correo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}">
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="eps">EPS</label>
                <input type="text" name="eps" class="form-control @error('eps') is-invalid @enderror" value="{{ old('eps') }}">
                @error('eps')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="rh">RH</label>
                <input type="text" name="rh" class="form-control @error('rh') is-invalid @enderror" value="{{ old('rh') }}">
                @error('rh')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <hr>
        <h4>Datos de usuario</h4>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre_usuario">Nombre de usuario</label>
                <input type="text" name="nombre_usuario" class="form-control @error('nombre_usuario') is-invalid @enderror" value="{{ old('nombre_usuario') }}" required>
                @error('nombre_usuario')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" class="form-control @error('contraseña') is-invalid @enderror" required minlength="6">
                @error('contraseña')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
