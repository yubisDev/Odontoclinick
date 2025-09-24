@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Pago</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Hay problemas con los datos ingresados.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pagos.update', $pago->id_pago) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="id_cita">Cita</label>
                <select name="id_cita" id="id_cita" class="form-control" required>
                    <option value="">Seleccione una cita</option>
                    @foreach ($citas as $cita)
                        <option value="{{ $cita->id_cita }}" {{ old('id_cita', $pago->id_cita) == $cita->id_cita ? 'selected' : '' }}>
                            Paciente: {{ $cita->paciente->nombre }} {{ $cita->paciente->apellidos }} | Médico: {{ $cita->medico->nombre }} {{ $cita->medico->apellidos }}
                        </option>
                    @endforeach
                </select>
                @error('id_cita')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="fecha_pago">Fecha de Pago</label>
                <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" value="{{ old('fecha_pago', \Carbon\Carbon::parse($pago->fecha_pago)->format('Y-m-d')) }}" required>
                @error('fecha_pago')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="monto">Monto</label>
                <input type="number" step="0.01" name="monto" id="monto" class="form-control" value="{{ old('monto', $pago->monto) }}" required>
                @error('monto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="metodo_pago">Método de Pago</label>
                <input type="text" name="metodo_pago" id="metodo_pago" class="form-control" value="{{ old('metodo_pago', $pago->metodo_pago) }}" required>
                @error('metodo_pago')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
