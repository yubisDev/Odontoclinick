@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="mb-4">
        <h2>Bienvenida, <span class="text-primary">{{ Auth::user()->nombre_usuario }}</span></h2>
        <hr>
    </div>

    {{-- Próximas Citas --}}
    <h4 class="mb-3">Próximas Citas</h4>
    <div class="card shadow-sm rounded mb-4">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citasProximas as $cita)
                        <tr>
                            <td>{{ $cita->paciente->nombre ?? '' }} {{ $cita->paciente->apellidos ?? '' }}</td>
                            <td>{{ $cita->medico->nombre ?? '' }} {{ $cita->medico->apellidos ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('H:i') }}</td>
                            <td>{{ ucfirst($cita->estado) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay próximas citas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Citas Pasadas --}}
    <h4 class="mb-3">Historial de Citas</h4>
    <div class="card shadow-sm rounded">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citasPasadas as $cita)
                        <tr>
                            <td>{{ $cita->paciente->nombre ?? '' }} {{ $cita->paciente->apellidos ?? '' }}</td>
                            <td>{{ $cita->medico->nombre ?? '' }} {{ $cita->medico->apellidos ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha_horario)->format('H:i') }}</td>
                            <td>{{ ucfirst($cita->estado) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay historial de citas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
