@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Bienvenido, {{ Auth::user()->nombre_usuario }}</h2>
        </div>

    <hr class="my-4">

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-calendar-check-fill me-2 fs-5"></i>
            <h4 class="m-0">Próximas Citas</h4>
        </div>
        <div class="card-body">
            @forelse($citasProximas as $cita)
                <div class="alert alert-info d-flex justify-content-between align-items-center p-3 mb-2">
                    <div>
                        <p class="mb-1 fw-bold">{{ $cita->medico->nombre }} - <span class="fw-normal">{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('d/m/Y') }}</span></p>
                        <span class="badge bg-secondary me-2"><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($cita->fecha_horario)->format('H:i') }}</span>
                        <span class="badge bg-success"><i class="bi bi-info-circle-fill"></i> {{ $cita->estado }}</span>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center m-0">
                    No tienes citas programadas.
                </div>
            @endforelse
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white d-flex align-items-center">
            <i class="bi bi-calendar-minus-fill me-2 fs-5"></i>
            <h4 class="m-0">Citas Pasadas</h4>
        </div>
        <div class="card-body">
            @forelse($citasPasadas as $cita)
                <div class="border-bottom p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 fw-bold">{{ $cita->medico->nombre }} - <span class="fw-normal">{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('d/m/Y') }}</span></p>
                        <span class="badge bg-light text-dark me-2 border"><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($cita->fecha_horario)->format('H:i') }}</span>
                        <span class="badge bg-dark"><i class="bi bi-info-circle-fill"></i> {{ $cita->estado }}</span>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center m-0">
                    No tienes citas pasadas.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection