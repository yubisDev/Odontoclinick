@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Registrar Pago</h2>

    <a href="{{ route('pagos.index') }}" class="btn btn-secondary mb-3">← Volver</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pagos.store') }}" method="POST">
        @csrf

        {{-- Selección de cita --}}
        <div class="mb-3">
            <label for="id_cita" class="form-label">Cita</label>
            <select name="id_cita" id="id_cita" class="form-select" required>
                <option value="">Seleccione una cita...</option>
                @foreach($citas as $cita)
                    <option value="{{ $cita->id_cita }}">
                        {{ $cita->id_cita }} - 
                        Paciente: {{ $cita->paciente->nombre ?? 'N/A' }} | 
                        Médico: {{ $cita->medico->nombre ?? 'N/A' }} | 
                        {{-- Se corrige la fecha, usando 'fecha_horario' y extrayendo solo la fecha --}}
                        Fecha: {{ \Carbon\Carbon::parse($cita->fecha_horario)->format('d-m-Y') }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha del pago --}}
        <div class="mb-3">
            <label for="fecha_pago" class="form-label">Fecha del Pago</label>
            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" 
                value="{{ old('fecha_pago', date('Y-m-d')) }}" required>
        </div>

        {{-- Monto --}}
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" name="monto" id="monto" step="0.01" min="0" 
                class="form-control" value="{{ old('monto') }}" required>
        </div>

        {{-- Método de pago --}}
        <div class="mb-3">
            <label for="metodo_pago" class="form-label">Método de Pago</label>
            <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="Tarjeta" {{ old('metodo_pago') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Pago</button>
    </form>
</div>
@endsection
