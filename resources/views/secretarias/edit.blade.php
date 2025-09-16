@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Editar Secretaria</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('secretarias.update', $secretaria->id_secretaria) }}" method="POST">
                @csrf
                @method('PUT')

                <h5 class="mb-3 text-secondary">Información Personal</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $secretaria->nombre) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos', $secretaria->apellidos) }}" required>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $secretaria->telefono) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control" value="{{ old('correo', $secretaria->correo) }}" required>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
                        <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $secretaria->fecha_ingreso) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="activo" {{ old('estado', $secretaria->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estado', $secretaria->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">
                <h5 class="mb-3 text-secondary">Datos de Usuario</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                        <input type="text" name="nombre_usuario" class="form-control" value="{{ old('nombre_usuario', $secretaria->usuario->nombre_usuario) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="contraseña" class="form-label">Nueva contraseña (opcional)</label>
                        <input type="password" name="contraseña" class="form-control">
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('secretarias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
