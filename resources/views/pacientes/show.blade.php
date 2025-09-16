@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Mis Datos</h2>
    <hr>

    <div class="card p-4">
        <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
        <p><strong>Documento:</strong> {{ $paciente->documento }}</p>
        <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
        <p><strong>Correo:</strong> {{ $paciente->correo }}</p>
        <p><strong>RH:</strong> {{ $paciente->rh }}</p>
        <p><strong>Estado:</strong> {{ $paciente->estado ? 'Activo' : 'Inactivo' }}</p>
    </div>
</div>
@endsection
