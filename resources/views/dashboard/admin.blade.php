@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Botón de cerrar sesión -->
    <div class="d-flex justify-content-end mb-4">
    </div>

    <h2 class="mb-4">Bienvenido, {{ Auth::user()->nombre_usuario }}</h2>
    <hr>

    <div class="row text-center">
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5>Total Secretarias</h5>
                    <h3>{{ $secretarias->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5>Total Médicos</h5>
                    <h3>{{ $medicos->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                    <h5>Total Pacientes</h5>
                    <h3>{{ \App\Models\Paciente::count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white mb-3">
                <div class="card-body">
                    <h5>Total Citas</h5>
                    <h3>{{ \App\Models\Cita::count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
