@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Horario</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Hay problemas con los datos ingresados.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('horarios.update', $horario->id_horarios) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="id_doctor" class="form-label">Médico</label>
                <select name="id_doctor" id="id_doctor" class="form-control" required>
                    <option value="">Seleccione un médico</option>
                    @foreach($medicos as $medico)
                        <option value="{{ $medico->id_doctor }}" {{ old('id_doctor', $horario->id_doctor) == $medico->id_doctor ? 'selected' : '' }}>
                            {{ $medico->nombre }} {{ $medico->apellidos }}
                        </option>
                    @endforeach
                </select>
                @error('id_doctor')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="dia_semana" class="form-label">Día de la Semana</label>
                <select name="dia_semana" id="dia_semana" class="form-control" required>
                    <option value="">Seleccione un día</option>
                    <option value="Lunes" {{ old('dia_semana', $horario->dia_semana) == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                    <option value="Martes" {{ old('dia_semana', $horario->dia_semana) == 'Martes' ? 'selected' : '' }}>Martes</option>
                    <option value="Miércoles" {{ old('dia_semana', $horario->dia_semana) == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
                    <option value="Jueves" {{ old('dia_semana', $horario->dia_semana) == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                    <option value="Viernes" {{ old('dia_semana', $horario->dia_semana) == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                    <option value="Sábado" {{ old('dia_semana', $horario->dia_semana) == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                    <option value="Domingo" {{ old('dia_semana', $horario->dia_semana) == 'Domingo' ? 'selected' : '' }}>Domingo</option>
                </select>
                @error('dia_semana')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio', \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i')) }}" required>
                @error('hora_inicio')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="hora_fin" class="form-label">Hora de Fin</label>
                <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ old('hora_fin', \Carbon\Carbon::parse($horario->hora_fin)->format('H:i')) }}" required>
                @error('hora_fin')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="cant_pacientes" class="form-label">Cantidad de Pacientes</label>
                <input type="number" name="cant_pacientes" id="cant_pacientes" class="form-control" min="1" value="{{ old('cant_pacientes', $horario->cant_pacientes) }}" required>
                @error('cant_pacientes')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <button type="submit" class="btn btn-success">Actualizar Horario</button>
        <a href="{{ route('horarios.panel') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection