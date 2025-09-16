@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Cita</h1>

    <form action="{{ route('citas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_paciente">Paciente</label>
            <select name="id_paciente" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}">{{ $paciente->nombre }} {{ $paciente->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_doctor">Médico</label>
            <select name="id_doctor" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id_doctor }}">{{ $medico->nombre }} {{ $medico->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_horario">Fecha y Hora</label>
            <input type="datetime-local" name="fecha_horario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control">
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="atendida">Atendida</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notas">Notas</label>
            <textarea name="notas" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
