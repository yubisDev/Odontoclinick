@extends('layouts.auth')

@section('title', 'Registro de Usuario')

@section('content')
<h2 class="mb-4 text-center">Registro</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}" id="registerForm">
    @csrf

    <div class="mb-3">
        <label for="nombre_usuario" class="form-label">Usuario</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="{{ old('nombre_usuario') }}" required autofocus>
        <div class="invalid-feedback">El usuario es obligatorio y debe ser único.</div>
    </div>

    <div class="mb-3">
        <label for="contraseña" class="form-label">Contraseña</label>
        <input type="password" name="contraseña" id="contraseña" class="form-control" required>
        <div class="invalid-feedback">La contraseña debe tener al menos 6 caracteres.</div>
    </div>

    <div class="mb-3">
        <label for="contraseña_confirmation" class="form-label">Confirmar Contraseña</label>
        <input type="password" name="contraseña_confirmation" id="contraseña_confirmation" class="form-control" required>
        <div class="invalid-feedback">Las contraseñas deben coincidir.</div>
    </div>

    <div class="mb-3">
        <label for="id_rol" class="form-label">Rol</label>
        <select name="id_rol" id="id_rol" class="form-control" required>
            @foreach(\App\Models\Rol::all() as $rol)
                <option value="{{ $rol->id_rol }}" {{ old('id_rol') == $rol->id_rol ? 'selected' : '' }}>
                    {{ ucfirst($rol->nombre_rol) }}
                </option>
            @endforeach
        </select>
        <div class="invalid-feedback">Selecciona un rol válido.</div>
    </div>

    <button type="submit" class="btn btn-success w-100">Registrar</button>

    <div class="mt-3 text-center">
        <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</form>

<script>
    const registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', function(event) {
        let valid = true;

        const user = document.getElementById('nombre_usuario');
        const pass = document.getElementById('contraseña');
        const confirmPass = document.getElementById('contraseña_confirmation');
        const rol = document.getElementById('id_rol');

        // Validar usuario
        if(user.value.trim() === '') {
            user.classList.add('is-invalid');
            valid = false;
        } else {
            user.classList.remove('is-invalid');
        }

        // Validar contraseña
        if(pass.value.length < 6) {
            pass.classList.add('is-invalid');
            valid = false;
        } else {
            pass.classList.remove('is-invalid');
        }

        // Validar confirmación
        if(pass.value !== confirmPass.value || confirmPass.value === '') {
            confirmPass.classList.add('is-invalid');
            valid = false;
        } else {
            confirmPass.classList.remove('is-invalid');
        }

        // Validar rol
        if(rol.value === '') {
            rol.classList.add('is-invalid');
            valid = false;
        } else {
            rol.classList.remove('is-invalid');
        }

        if(!valid) event.preventDefault();
    });
</script>
@endsection
