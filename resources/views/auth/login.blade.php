@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="mb-4">
    <a href="{{ url('/') }}" class="btn btn-secondary">&larr; Volver</a>
</div>

<h2 class="mb-4 text-center">Iniciar Sesión</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}" id="loginForm">
    @csrf

    <div class="mb-3">
        <label for="nombre_usuario" class="form-label">Usuario</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="{{ old('nombre_usuario') }}" required autofocus>
        <div class="invalid-feedback">Ingresa tu usuario.</div>
    </div>

    <div class="mb-3">
        <label for="contraseña" class="form-label">Contraseña</label>
        <input type="password" name="contraseña" id="contraseña" class="form-control" required>
        <div class="invalid-feedback">Ingresa tu contraseña.</div>
    </div>

    <button type="submit" class="btn btn-primary w-100">Ingresar</button>

    <div class="mt-3 text-center">
        <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
    </div>
</form>

<script>
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(event) {
        let valid = true;

        const user = document.getElementById('nombre_usuario');
        const pass = document.getElementById('contraseña');

        if(user.value.trim() === '') {
            user.classList.add('is-invalid');
            valid = false;
        } else {
            user.classList.remove('is-invalid');
        }

        if(pass.value.trim() === '') {
            pass.classList.add('is-invalid');
            valid = false;
        } else {
            pass.classList.remove('is-invalid');
        }

        if(!valid) event.preventDefault();
    });
</script>
@endsection
