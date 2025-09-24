@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <div class="card-header bg-primary text-white text-center rounded-top">
            <h2 class="card-title mb-0">Crear Nuevo Horario</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @enderror

            <form action="{{ route('horarios.store') }}" method="POST">
                @csrf
                
                {{-- Sección de selección de médico solo para administradores --}}
                @if(Auth::user()->id_rol == 1)
                    <div class="mb-3">
                        <label for="id_doctor" class="form-label">Médico</label>
                        <select class="form-select @error('id_doctor') is-invalid @enderror" id="id_doctor" name="id_doctor" required>
                            <option value="">Seleccione un médico</option>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id_doctor }}" {{ old('id_doctor') == $medico->id_doctor ? 'selected' : '' }}>
                                    {{ $medico->nombre }} {{ $medico->apellidos }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_doctor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @else
                    {{-- Campo oculto para médicos, para que el ID se envíe automáticamente --}}
                    <input type="hidden" name="id_doctor" value="{{ Auth::user()->medico?->id_doctor }}">
                @endif
                
                <div class="mb-3">
                    <label for="dia_semana" class="form-label">Día de la Semana</label>
                    <select class="form-select @error('dia_semana') is-invalid @enderror" id="dia_semana" name="dia_semana" required>
                        <option value="">Seleccione un día</option>
                        <option value="Lunes" {{ old('dia_semana') == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                        <option value="Martes" {{ old('dia_semana') == 'Martes' ? 'selected' : '' }}>Martes</option>
                        <option value="Miércoles" {{ old('dia_semana') == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
                        <option value="Jueves" {{ old('dia_semana') == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                        <option value="Viernes" {{ old('dia_semana') == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                        <option value="Sábado" {{ old('dia_semana') == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                    </select>
                    @error('dia_semana')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required>
                    @error('hora_inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hora_fin" class="form-label">Hora de Fin</label>
                    <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" required>
                    @error('hora_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cant_pacientes" class="form-label">Cantidad de Pacientes</label>
                    <input type="number" class="form-control @error('cant_pacientes') is-invalid @enderror" id="cant_pacientes" name="cant_pacientes" value="{{ old('cant_pacientes') }}" required min="1">
                    @error('cant_pacientes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    {{-- El botón de regreso ahora se adapta al rol del usuario --}}
                    @if(Auth::user()->id_rol == 1)
                        <a href="{{ route('horarios.admin.panel') }}" class="btn btn-secondary">Cancelar</a>
                    @else
                        <a href="{{ route('horarios.medico.panel') }}" class="btn btn-secondary">Cancelar</a>
                    @endif
                    <button type="submit" class="btn btn-success">Guardar Horario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
