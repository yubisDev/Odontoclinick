@extends('layouts.app')

@section('title', 'Dashboard Médico')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">👨‍⚕️ Bienvenido, Dr. {{ Auth::user()->nombre_usuario }}</h2>
    <hr>

    <div class="row g-4">
        {{-- 🔹 Citas Próximas --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Citas Próximas</h5>
                </div>
                <div class="card-body">
                    @if($citasProximas->isEmpty())
                        <p class="text-muted">No hay citas próximas programadas.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($citasProximas as $cita)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>👤 {{ $cita->paciente->nombre }} {{ $cita->paciente->apellidos }}</strong><br>
                                        📅 {{ \Carbon\Carbon::parse($cita->fecha_horario)->format('d/m/Y') }} <br>
                                        ⏰ {{ \Carbon\Carbon::parse($cita->fecha_horario)->format('H:i') }}
                                    </div>
                                    <a href="{{ route('historial.create', ['id_paciente' => $cita->paciente->id_paciente, 'id_cita' => $cita->id_cita]) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                       <i class="bi bi-journal-plus"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        {{-- 🔹 Historiales Clínicos --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-info">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-folder2-open me-2"></i>Historiales Clínicos</h5>
                </div>
                <div class="card-body text-center">
                    <p class="text-muted">Consulta todos los historiales clínicos de tus pacientes.</p>
                    <a href="{{ route('historial.index_all') }}" class="btn btn-info text-white fw-bold">
                        <i class="bi bi-search me-2"></i> Ver Historiales
                    </a>
                </div>
            </div>
        </div>

        {{-- 🔹 Historial de Citas Pasadas --}}
        <div class="col-md-12">
            <div class="card shadow-sm border-secondary">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Historial de Citas Pasadas</h5>
                </div>
                <div class="card-body">
                    @if($citasPasadas->isEmpty())
                        <p class="text-muted">No hay historial de citas.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($citasPasadas as $cita)
                                <li class="list-group-item">
                                    <strong>👤 {{ $cita->paciente->nombre }} {{ $cita->paciente->apellidos }}</strong><br>
                                    📅 {{ \Carbon\Carbon::parse($cita->fecha_horario)->format('d/m/Y') }} <br>
                                    ⏰ {{ \Carbon\Carbon::parse($cita->fecha_horario)->format('H:i') }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
