@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cita</h1>

    <form action="{{ route('citas.update', $cita->id_cita) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_paciente">Paciente</label>
            <select name="id_paciente" class="form-control" required>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}" {{ $cita->id_paciente == $paciente->id_paciente ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_doctor">Médico</label>
            <select name="id_doctor" class="form-control" required>
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id_doctor }}" {{ $cita->id_doctor == $medico->id_doctor ? 'selected' : '' }}>
                        {{ $medico->nombre }} {{ $medico->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_horario">Fecha y Hora</label>
            <input type="datetime-local" name="fecha_horario" value="{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('Y-m-d\TH:i') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control">
                <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="atendida" {{ $cita->estado == 'atendida' ? 'selected' : '' }}>Atendida</option>
                <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notas">Notas</label>
            <textarea name="notas" class="form-control">{{ $cita->notas }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
