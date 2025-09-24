@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detalles del Pago</h2>
    <hr>
    
    <div class="row">
        <div class="col-md-6">
            <h4>Información de Pago</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Fecha de Pago:</strong> {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                </li>
                <li class="list-group-item">
                    <strong>Monto:</strong> ${{ number_format($pago->monto, 2) }}
                </li>
                <li class="list-group-item">
                    <strong>Método de Pago:</strong> {{ $pago->metodo_pago }}
                </li>
            </ul>
        </div>
        
        <div class="col-md-6">
            <h4>Información de la Cita</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>ID de Cita:</strong> {{ $pago->cita->id_cita }}
                </li>
                <li class="list-group-item">
                    <strong>Fecha de Cita:</strong> {{ \Carbon\Carbon::parse($pago->cita->fecha_cita)->format('d/m/Y') }}
                </li>
                <li class="list-group-item">
                    <strong>Paciente:</strong> {{ $pago->cita->paciente->nombre }} {{ $pago->cita->paciente->apellidos }}
                </li>
                <li class="list-group-item">
                    <strong>Médico:</strong> {{ $pago->cita->medico->nombre }} {{ $pago->cita->medico->apellidos }}
                </li>
            </ul>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Volver a la Lista de Pagos</a>
    </div>
</div>
@endsection
