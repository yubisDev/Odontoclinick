@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Menú lateral -->
        <div class="col-md-2 bg-light vh-100 p-3">
            <h4>Doctor</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="{{ route('mis.citas') }}">Mis Citas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('pacientes.index') }}">Pacientes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('procedimientos.index') }}">Procedimientos</a></li>
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="col-md-10 p-4">
            <h2>Bienvenido, Dr. {{ Auth::user()->nombre_usuario }}</h2>
            <hr>

            <h4>Mis Próximas Citas</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td>{{ $cita->paciente->nombre }}</td>
                            <td>{{ $cita->fecha }}</td>
                            <td>{{ $cita->hora }}</td>
                            <td>{{ $cita->estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
