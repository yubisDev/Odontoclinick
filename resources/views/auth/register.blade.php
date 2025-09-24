@extends('layouts.auth')

@section('title', 'Registro de Usuario')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center fw-bold">Registro de Usuario</h2>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" id="registerForm" class="p-4 border rounded shadow-sm bg-light">
        @csrf

        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Usuario</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control @error('nombre_usuario') is-invalid @enderror" value="{{ old('nombre_usuario') }}" required autofocus>
            @error('nombre_usuario')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" required>
            @error('apellidos')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
            @error('correo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="id_rol" class="form-label">Rol</label>
            <select name="id_rol" id="id_rol" class="form-select @error('id_rol') is-invalid @enderror" required>
                <option value="">Seleccione un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id_rol }}" {{ old('id_rol') == $rol->id_rol ? 'selected' : '' }}>
                        {{ ucfirst($rol->nombre_rol) }}
                    </option>
                @endforeach
            </select>
            @error('id_rol')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campos dinámicos según rol --}}
        <div id="paciente-fields" class="border p-3 rounded mb-3 bg-white" style="display: none;">
            <h6 class="fw-bold">Datos del Paciente</h6>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="eps" class="form-label">EPS</label>
                <input type="text" name="eps" id="eps" class="form-control @error('eps') is-invalid @enderror" value="{{ old('eps') }}">
                @error('eps')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="rh" class="form-label">RH</label>
                <input type="text" name="rh" id="rh" class="form-control @error('rh') is-invalid @enderror" value="{{ old('rh') }}">
                @error('rh')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div id="medico-fields" class="border p-3 rounded mb-3 bg-white" style="display: none;">
            <h6 class="fw-bold">Datos del Médico</h6>
            <div class="mb-3">
                <label for="id_especialidad" class="form-label">Especialidad</label>
                <select name="id_especialidad" id="id_especialidad" class="form-select @error('id_especialidad') is-invalid @enderror">
                    <option value="">Seleccione una especialidad</option>
                    @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id_especialidad }}">{{ $especialidad->nombre_especialidad }}</option>
                    @endforeach
                </select>
                @error('id_especialidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telefono_medico" class="form-label">Teléfono</label>
                <input type="text" name="telefono_medico" id="telefono_medico" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div id="secretaria-fields" class="border p-3 rounded mb-3 bg-white" style="display: none;">
            <h6 class="fw-bold">Datos de la Secretaria</h6>
            <div class="mb-3">
                <label for="telefono_secretaria" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono_secretaria" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100 fw-bold">Registrar</button>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rolSelect = document.getElementById('id_rol');
    const pacienteFields = document.getElementById('paciente-fields');
    const medicoFields = document.getElementById('medico-fields');
    const secretariaFields = document.getElementById('secretaria-fields');

    function toggleFields() {
        // Ocultar todos los bloques
        [pacienteFields, medicoFields, secretariaFields].forEach(el => {
            el.style.display = 'none';
            el.querySelectorAll('input, select').forEach(i => i.disabled = true);
        });

        // Mostrar según el rol
        const selectedRolId = rolSelect.value;
        if (selectedRolId == 4) {
            pacienteFields.style.display = 'block';
            pacienteFields.querySelectorAll('input, select').forEach(i => i.disabled = false);
        } else if (selectedRolId == 2) {
            medicoFields.style.display = 'block';
            medicoFields.querySelectorAll('input, select').forEach(i => i.disabled = false);
        } else if (selectedRolId == 3) {
            secretariaFields.style.display = 'block';
            secretariaFields.querySelectorAll('input, select').forEach(i => i.disabled = false);
        }
    }

    toggleFields();
    rolSelect.addEventListener('change', toggleFields);
});
</script>
@endsection
