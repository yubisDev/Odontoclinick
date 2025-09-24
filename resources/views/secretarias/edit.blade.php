@extends('layouts.app')

@section('content')

<div class="container mt-5">
<div class="d-flex justify-content-between align-items-center mb-4">
<h2>Editar Secretaria: {{ $secretaria->nombre }} {{ $secretaria->apellidos }}</h2>
<a href="{{ route('secretarias.index') }}" class="btn btn-secondary">
<i class="bi bi-arrow-left me-1"></i> Volver al Listado
</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Formulario de Edición -->

<div class="card mb-5">
<div class="card-header bg-primary text-white">
<h5 class="mb-0">Datos de la Secretaria</h5>
</div>
<div class="card-body">
<form action="{{ route('secretarias.update', $secretaria->id_secretaria) }}" method="POST">
@csrf
@method('PUT')

        <!-- Campo oculto para el estado -->
        <input type="hidden" name="estado" value="{{ $secretaria->estado }}">

        <!-- Campo Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $secretaria->nombre) }}" required>
        </div>

        <!-- Campo Apellidos -->
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', $secretaria->apellidos) }}" required>
        </div>

        <!-- Campo Correo -->
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $secretaria->correo) }}" required>
        </div>

        <!-- Campo Teléfono -->
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $secretaria->telefono) }}">
        </div>

        <!-- Campo Nombre de Usuario -->
        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="{{ old('nombre_usuario', $secretaria->usuario->nombre_usuario) }}" required>
        </div>

        <!-- Campo Contraseña -->
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
            <input type="password" class="form-control" id="contrasena" name="contraseña">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Guardar Cambios
        </button>
    </form>
</div>

</div>

</div>
@endsection