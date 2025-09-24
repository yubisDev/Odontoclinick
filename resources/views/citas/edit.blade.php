@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Cita</h2>

    <form action="{{ route('citas.update', $cita->id_cita) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Paciente -->
        <div class="mb-3">
            <label class="form-label">Paciente</label>
            <select name="id_paciente" class="form-control" required>
                <option value="">Seleccione un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}" 
                        {{ $cita->id_paciente == $paciente->id_paciente ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Médico -->
        <div class="mb-3">
            <label class="form-label">Doctor</label>
            <select name="id_doctor" class="form-control" required>
                <option value="">Seleccione un doctor</option>
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id_doctor }}" 
                        {{ $cita->id_doctor == $medico->id_doctor ? 'selected' : '' }}>
                        {{ $medico->nombre }} {{ $medico->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Fecha y Hora -->
        <div class="mb-3">
            <label class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="fecha_horario" class="form-control" 
                value="{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('Y-m-d\TH:i') }}" required>
        </div>

        <!-- Estado -->
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <!-- Notas -->
        <div class="mb-3">
            <label class="form-label">Notas</label>
            <textarea name="notas" class="form-control">{{ $cita->notas }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
