@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="mb-4">
        <h2>Bienvenido, <span class="text-primary">{{ Auth::user()->nombre_usuario }}</span></h2>
        <hr>
    </div>

    <h4 class="mb-3">Próximas Citas</h4>
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
                        @forelse($citas as $cita)
                            <tr>
                                <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellidos ?? '' }}</td>
                                <td>{{ $cita->doctor->nombre }} {{ $cita->doctor->apellidos ?? '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                                <td>
                                    @if($cita->estado == 'pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @elseif($cita->estado == 'confirmada')
                                        <span class="badge bg-success">Confirmada</span>
                                    @elseif($cita->estado == 'cancelada')
                                        <span class="badge bg-danger">Cancelada</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($cita->estado) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay citas próximas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
