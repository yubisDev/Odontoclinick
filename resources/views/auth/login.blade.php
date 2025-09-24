@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="mb-4">
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">&larr; Volver</a>
</div>

<h2 class="mb-4 text-center fw-bold">Iniciar Sesión</h2>

@if ($errors->any())
    <div class="alert alert-danger shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}" id="loginForm" class="shadow-sm p-4 rounded bg-white">
    @csrf

    <div class="mb-3">
        <label for="nombre_usuario" class="form-label fw-semibold">Usuario</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" 
               class="form-control @error('nombre_usuario') is-invalid @enderror" 
               value="{{ old('nombre_usuario') }}" required autofocus>
        @error('nombre_usuario')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="contraseña" class="form-label fw-semibold">Contraseña</label>
        <input type="password" name="contraseña" id="contraseña" 
               class="form-control @error('contraseña') is-invalid @enderror" required>
        @error('contraseña')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Ingresar</button>

    <div class="mt-3 text-center">
        <a href="{{ route('register') }}" class="text-decoration-none">¿No tienes cuenta? Regístrate</a>
    </div>
</form>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
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

<style>
    form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #f8f9fa;
        border-radius: 15px;
    }

    .btn-primary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    input:focus {
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
    }
</style>
@endsection
