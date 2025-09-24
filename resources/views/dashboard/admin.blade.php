@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <h2 class="mb-4 text-center">Bienvenido, {{ Auth::user()->nombre_usuario }}</h2>
    <hr>

    <div class="row text-center g-4">

        <!-- Total Secretarias -->
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-lg rounded">
                <div class="card-body">
                    <i class="bi bi-people-fill display-4 mb-2"></i>
                    <h5 class="card-title">Secretarias</h5>
                    <h3 class="fw-bold">{{ $secretarias->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Médicos -->
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-lg rounded">
                <div class="card-body">
                    <i class="bi bi-person-badge display-4 mb-2"></i>
                    <h5 class="card-title">Médicos</h5>
                    <h3 class="fw-bold">{{ $medicos->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Pacientes -->
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow-lg rounded">
                <div class="card-body">
                    <i class="bi bi-person-fill display-4 mb-2"></i>
                    <h5 class="card-title">Pacientes</h5>
                    <h3 class="fw-bold">{{ \App\Models\Paciente::count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Citas -->
        <div class="col-md-3">
            <div class="card bg-info text-white shadow-lg rounded">
                <div class="card-body">
                    <i class="bi bi-calendar-check display-4 mb-2"></i>
                    <h5 class="card-title">Citas</h5>
                    <h3 class="fw-bold">{{ \App\Models\Cita::count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Pagos -->
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow-lg rounded">
                <div class="card-body">
                    <i class="bi bi-cash-stack display-4 mb-2"></i>
                    <h5 class="card-title">Pagos</h5>
                    <h3 class="fw-bold">{{ \App\Models\Pago::count() }}</h3>
                </div>
            </div>
        </div>
        <!-- Total Productos -->
        <div class="col-md-3">
            <div class="card bg-secondary text-white shadow-lg rounded">
                <div class="card-body">
                    <i class="bi bi-bag-check display-4 mb-2"></i>
                    <h5 class="card-title">Productos</h5>
                    <h3 class="fw-bold">{{ \App\Models\Producto::count() }}</h3>
                </div>
            </div>
        </div>>
@endsection
